<?php

namespace App\Http\Controllers;
use App\Events\SendMail;
use App\Models\EmailTemplate;
use App\Models\ItemExtra;
use App\Models\OrderExtra;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Unicodeveloper\Paystack\Paystack;
use App\Models\Item;
use App\Models\RoomItems;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderDetails;
use App\Models\Restaurant;
use App\Models\UserPlan;
use App\Models\CustOrderWhatsapp;
use App\Models\RestaurantTwilioGateway;
use Illuminate\Http\Request;
use PayPal\Api\Payment;
use paytm\paytmchecksum\PaytmChecksum;
use DB;
use Session;
use Twilio\Rest\Client;
use App\Models\Table;
use App\Models\Setting;

class OrderController extends Controller
{


    public function index()
    {   
        $user=auth()->user();
        if ($user->type == 'user') {
            $res_id = User::where('id',$user->id)->pluck('restaurant_id');
            $restaurants = Restaurant::where('user_id', $res_id)->pluck('id');
            $data['orders'] = Order::where('restaurant_id', $restaurants)->orWhere('user_id', $user->restaurant_id)->orderBy('created_at', 'desc')->get();
        } else if ($user->type == 'customer') {
            $data['orders'] = Order::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        }
        else if ($user->type == 'admin') {
            //$restaurants = Restaurant::where('user_id', auth()->id())->pluck('id');
            $data['orders'] = Order::orderBy('created_at', 'desc')->get();
        } 
        else {
            $restaurants = Restaurant::where('user_id', auth()->id())->pluck('id');
            $data['orders'] = Order::whereIn('restaurant_id', $restaurants)->orWhere('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        }
        //echo "<pre>";print_r($data);die;
        return view('order.index', $data);
    }

    public function show(Request $request)
    {
        $data['order'] = $order = Order::with('details')->find($request->id);
        if(!$order) 
            return redirect()->back()->withErrors(['msg' => 'Order not found']);
        
        return view('order.details', $data);

    }

    public function destroy(Request $request)
    {
        //
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'item_id.*' => 'required',
            'category_type'=>'required',
            'item_quantity.*' => 'required',
            'name' => 'required',
            'table_id' => 'required',
            'restaurant' => 'required',
            'pay_type' => 'required|in:pay_on_table,pay_now',
            'whatsappnum' => 'required|max:12',
        ]);
        if($request->category_type=='food'){
            $allRoomOrders = OrderDetails::
            join('orders','orders.id','=','order_details.order_id')
            ->where('category_type','room')
            ->select('orders.status as status')->get()->toArray();
            foreach($allRoomOrders as $single){
                if($single['status'] == 'rejected' || $single['status'] == 'delivered'){  
                   return redirect()->back()->withErrors(['msg' => trans('layout.message.already_room_order_in_process')]);
                }
            }
        }
        if($request->category_type=='room'){
            $allRoomOrders = OrderDetails::
            join('orders','orders.id','=','order_details.order_id')
            ->where('category_type','food')
            ->select('orders.status as status')->get()->toArray();
            foreach($allRoomOrders as $single){
                if($single['status'] == 'rejected' || $single['status'] == 'delivered'){  
                   return redirect()->back()->withErrors(['msg' => trans('layout.message.already_food_order_in_process')]);
                }
            }
        }
        $restaurant = Restaurant::find($request->restaurant);
        if (!$restaurant) return redirect()->back()->withErrors(['msg' => trans('layout.message.order_not_found')]);
        
        $order = new Order();
        $order->user_id = auth()->id();
        $order->name = $request->name;
        $order->table_id = $request->table_id;
        $order->restaurant_id = $request->restaurant;
        $number_exist = CustOrderWhatsapp::where('whatsappnum', '=', $request->countryCode.$request->whatsappnum)->first();
        if(!empty($number_exist)){
            $order->cust_phone_id = $number_exist->id;
        }else{
            $id = DB::table('cust_order_whatsapp')->insertGetId(array(
                    'whatsappnum' => $request->countryCode.$request->whatsappnum,
                    'created_at' => now(),
                    'updated_at' => now()
            ));
            $order->cust_phone_id = $id;
        }

        if ($request->pay_type == 'pay_on_table') {
            $order->payment_status = 'unpaid';
        }
        $order->comment = $request->comment;
        $order->save();

        $totalPrice = 0;
        $orderDetailsData = [];
        $i = 0;
        foreach ($request->item_id as $key => $item_id) {
            $orderQuantity = $request->item_quantity[$key];
            if($request->category_type=='food'){
            $item = Item::where(['id' => $item_id, 'restaurant_id' => $request->restaurant])->first();
           
            }
            else{
                $item = RoomItems::where(['id' => $item_id, 'restaurant_id' => $request->restaurant])->first();
                
            }
            if(!empty($item->price)){
                $price = $item->price;
            }else{
                $price = 0;
            }
            
            $discountPrice = 0;
            if ($item) {
                if ($item->discount > 0) {
                    if ($item->discount_type == 'flat') {
                        $discountPrice = $item->discount;
                        $price = $item->price - $discountPrice;
                    } elseif ($item->discount_type == 'percent') {
                        $discountPrice = ($item->price * $item->discount) / 100;
                        $price = $item->price - $discountPrice;
                    }
                }else {
                    if(!empty($item->price)){
                        $price = $item->price;
                    }else{
                    $price = 0;
                    }
                }

                $orderDetailsData[$i]['order_id'] = $order->id;
                $orderDetailsData[$i]['item_id'] = $item->id;
                $orderDetailsData[$i]['category_type'] = $request->category_type;
                $orderDetailsData[$i]['price'] = $price;
                $orderDetailsData[$i]['quantity'] = $orderQuantity;
                $orderDetailsData[$i]['discount'] = $discountPrice;
                $orderDetailsData[$i]['total'] = $price * $orderQuantity;
                $orderDetailsData[$i]['created_at'] = now();
                $orderDetailsData[$i]['updated_at'] = now();
                $totalPrice += ($price * $orderQuantity);
                $i++;
            }
        }
        OrderDetails::insert($orderDetailsData);
        $order->total_price = $totalPrice;
        $order->save();
        $itemsname = [];
        $allItmes = Item::find($request->item_id);
        foreach ($allItmes as $key => $allItme) {
            $itemsname[] = $request->item_quantity[$key].'x '.$allItme->name;
        }
        $listitem = implode(',', $itemsname);
        // Get twillo SID and Token Send Msg Resturant to User
        $twillo_details = RestaurantTwilioGateway::where('user_id',$restaurant->user_id)->first();
        $user_deatils = User::where('id',$order->user_id)->first();
//         try{
//             if(!empty($twillo_details)){
//             $twillo_results = json_decode($twillo_details->value, true);
//             $sid = $twillo_results['twilio_sid'];
//             $token = $twillo_results['twilio_token'];
//             $twillo_from = '+'.$user_deatils->countrycode.$user_deatils->phone_number;//'+'.$twillo_results['countrycode'].$twillo_results['whatsappnumber'];
//             $twillo_to = $request->countryCode.$request->whatsappnum;
//             $twilio = new Client($sid, $token);
//             $message = $twilio->messages
//                   ->create("whatsapp:$twillo_to", // to
//                            [
//                                "from" => "whatsapp:$twillo_from",
//                                "body" => "Hey $request->name

// Thanks for ordering from $restaurant->name. Your order is being processed and will be served to you as quickly as possible.  

// Your order number is $order->id


// Best,
// Team $restaurant->name"
//                            ]
//                   );
//         }
//          // Get twillo SID and Token Send Msg Admin to Resturant
//         $twillo_details_admin = Setting::where('name', 'sms_gateway')->first();
//         $rest_table_name = Table::where('id',$request->table_id)->first();
//         if(!empty($twillo_details_admin)){
//             $twillo_results_admin = json_decode($twillo_details_admin->value, true);
//             $admin_sid = $twillo_results_admin['twilio_sid'];
//             $admin_token = $twillo_results_admin['twilio_token'];
//             $admin_twillo_from = '+'.$twillo_results_admin['countrycode'].$twillo_results_admin['whatsappnumber'];
//             $admin_twillo_to = '+'.$twillo_results['countrycode'].$twillo_results['whatsappnumber'];
//             $admin_twilio = new Client($admin_sid, $admin_token);
//             $message = $admin_twilio->messages
//                   ->create("whatsapp:$admin_twillo_to", // to
//                            [
//                                "from" => "whatsapp:$admin_twillo_from",
//                                "body" => "Dear Merchant, 

// Hey,
// An order of $listitem has arrived on your Qricle dashboard from table number $rest_table_name->name of Rs. $totalPrice.
// Please login to your Qricle dashboard for more details.
// Regards,
// Team Qricle"
//                            ]
//                   );
//         }
//         }catch (\Exception $ex) {
//             return redirect()->back()->withErrors(['msg' => trans('layout.message.invalid_twillo')]);
//         }

        if ($order->user_id)
            notification('order', $order->id, $order->user_id, "A new order has been placed");

        notification('order', $order->id, $restaurant->user_id, "A new order has been placed");

        if ($request->pay_type == 'pay_now') {
            if ($request->paymentMethod == 'paypal') {
                try {
                    $payment = $this->paypalPayment($order, $restaurant);
                    if ($payment)
                        return redirect()->to($payment->getApprovalLink());

                } catch (\Exception $ex) {
                    return redirect()->back()->withErrors(['msg' => trans('layout.message.invalid_payment')]);
                }
            } else if ($request->paymentMethod == 'stripe') {
                try {
                    $payment = $this->stripePayment($order, $request);
                    $order->transaction_id = $payment->id;
                    $order->payment_status = 'paid';
                    $order->save();
                    return redirect()->back()->with('order-success', trans('layout.message.order_placed'));
                } catch (\Exception $ex) {

                    return redirect()->back()->withErrors(['msg' => trans('layout.message.invalid_payment')]);
                }
            } else if ($request->paymentMethod == 'paytm') {
                try {
                    $paytmData = $this->payTmPayment($order);

                    return view('payment.paytm',$paytmData);
                  //  return redirect()->back()->with('order-success', trans('layout.message.order_placed'));
                } catch (\Exception $ex) {

                    return redirect()->back()->withErrors(['msg' => trans('layout.message.invalid_payment')]);
                }
            }
        }

        if ($request->pay_type == 'pay_on_table') {
            return redirect()->back()->with('order-success', trans('layout.message.order_placed'));
        }
        //    return redirect()->back()->with('order-success', trans('layout.message.order_placed'));

    }

    public function updateStatus(Request $request)
    {

        $order = Order::find($request->order_id);
        if (!$order) return response()->json(['failed' => trans('layout.message.order_not_found')]);
        if ($request->pay_status)
            $order->update(['payment_status' => $request->pay_status]);
        else if ($request->status) {
            if ($request->status == 'approved') {
                $request->validate([
                    'time' => 'numeric',
                    'type' => 'in:minutes,hours,days',
                ]);
                $order->update(['status' => $request->status, 'approved_at' => now(), 'delivered_within' => $request->time . '_' . $request->type]);
            } else {
                $order->update(['status' => $request->status]);
            }
        }
        if (!$request->ajax()) return redirect()->back()->with('success', trans('layout.message.order_status_update'));

        if ($order->user_id)
            notification('order', $order->id, $order->user_id, "Your order #" . $order->id . " status has been updated");


        return response()->json(['success' => trans('layout.message.order_status_update')]);
    }
     
    public function getData()
    {
        $authUser=auth()->user();
        if($authUser->type =='user'){
            $res_id = User::where('id',$authUser->id)->pluck('restaurant_id');
            $restaurants = Restaurant::where('user_id', $res_id)->pluck('id');
            $orders = Order::whereIn('restaurant_id', $restaurants)->orWhere('user_id', $authUser->id)->orderBy('created_at', 'desc')->get();
        }elseif($authUser->type !='admin'){
            $restaurants = Restaurant::where('user_id', $authUser->id)->pluck('id');
            $orders = Order::whereIn('restaurant_id', $restaurants)->orWhere('user_id', $authUser->id)->orderBy('created_at', 'desc')->get();
        }
        else{
            $orders = Order::orderBy('created_at', 'desc')->get();
        }
        $newData = [];


        if ($authUser->hasPermissionTo('order_payment_status_change')) {
            $paidString = "<div class=\"btn-group mb-1 show\"><div class=\"btn-group mb-1\"><button  class=\"btn btn-success light btn-xs dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\" aria-expanded=\"false\">" . trans('layout.paid') . "</button>
<div class=\"dropdown-menu\" x-placement=\"top-start\" style=\"position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -193px, 0px);\"> <a data-message='" . trans('layout.message.order_status_warning', ['status' => 'unpaid']) . "' data-method='post' data-action='#{data_action}' data-input='#{data_input}' data-toggle=\"modal\" data-isAjax=\"true\" data-target=\"#modal-confirm\" class=\"dropdown-item\" href=\"#\">" . trans('layout.unpaid') . "</a></div></div> </div>";

            $unpaidString = "<div class=\"btn-group mb-1 show\"><div class=\"btn-group mb-1\"><button  class=\"btn btn-danger light btn-xs dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\" aria-expanded=\"false\">" . trans('layout.unpaid') . "</button>
<div class=\"dropdown-menu\" x-placement=\"top-start\" style=\"position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -193px, 0px);\"> <a data-message='" . trans('layout.message.order_status_warning', ['status' => 'paid']) . "' data-method='post' data-action='#{data_action}' data-input='#{data_input}' data-toggle=\"modal\" data-isAjax=\"true\" data-target=\"#modal-confirm\" class=\"dropdown-item\" href=\"#\">" . trans('layout.paid') . "</a></div></div> </div>";
        } else {
            $paidString = "<button type='button' class='btn btn-success light btn-xs'>" . trans('layout.paid') . "</button>";
            $unpaidString = "<button type='button' class='btn btn-danger light btn-xs'>" . trans('layout.unpaid') . "</button>";
        }
        if($authUser->type =='admin'){
            $orders_details = Order::join('order_details as od','od.order_id','=','orders.id')
                            ->join('items as item','item.id','=','od.item_id')
                            ->leftjoin('roomitems as ritem','ritem.id','=','od.item_id')
                            ->select('orders.id as id','orders.status as status','orders.user_id as user_id','orders.table_id as table_id','orders.created_at as created_at','od.category_type as category_type','od.id as oid','item.name as item_name','ritem.name as ritem_name','orders.restaurant_id as restaurant_id','od.quantity as quantity')
                            ->orderBy('orders.created_at', 'desc')->get()->toArray();
            foreach ($orders_details as $k => $orders_detail) {
                $results[$orders_detail['id']][] = $orders_detail['quantity'].'x '.$orders_detail['item_name'];
                }
        }
        else
        {
        $orders_details = Order::whereIn('orders.restaurant_id', $restaurants)
                            ->join('order_details as od','od.order_id','=','orders.id')
                            ->leftjoin('items as item','item.id','=','od.item_id')
                            ->leftjoin('roomitems as ritem','ritem.id','=','od.item_id')
                            ->select('orders.id as id','orders.status as status','orders.user_id as user_id','orders.table_id as table_id','orders.created_at as created_at','od.category_type as category_type','od.id as oid','item.name as item_name','ritem.name as ritem_name','orders.restaurant_id as restaurant_id','od.quantity as quantity')
                            ->orderBy('orders.created_at', 'desc')->get()->toArray();
            $name = '';
            foreach ($orders_details as $k => $orders_detail) {
                if($orders_detail['ritem_name'] != ''){
                    $name = $orders_detail['ritem_name'];
                }
                if($orders_detail['item_name'] != ''){
                    $name = $orders_detail['item_name'];
                }

                $results[$orders_detail['id']][] = $orders_detail['quantity'].'x '.$name;
            }
        }
      
        foreach ($orders as $key => $order) {
            $order_id = $order->id;
            $newData[$key]['items'] = $results[$order->id];
            $vars = [
                '#{data_input}' => json_encode(['pay_status' => $order->payment_status == 'paid' ? 'unpaid' : 'paid', 'order_id' => $order->id]),
                '#{data_action}' => route('order.update.status')
            ];
            $newData[$key]['row'] = $key + 1;
            $newData[$key]['id'] = $order->id;
            $newData[$key]['name'] = $order->name;
            $newData[$key]['restaurant_name'] = $order->restaurant->name;
            $newData[$key]['table'] = $order->table->name;
            $newData[$key]['total_price'] = formatNumberWithCurrSymbol($order->total_price);
            if ($order->approved_at)
                $newData[$key]['delivered_within'] = $order->delivered_within . ' <span style="front-size: 10px">(approved: ' . $order->approved_at->diffForHumans() . ')</span>';
            else
                $newData[$key]['delivered_within'] = $order->delivered_within;
            if ($order->payment_status == 'unpaid')
                $newData[$key]['payment_status'] = strtr($unpaidString, $vars);
            else if ($order->payment_status == 'paid')
                $newData[$key]['payment_status'] = strtr($paidString, $vars);

            $status = '';
            if ($order->status == 'pending')
                $status = '<span class="badge badge-warning">' . trans('layout.pending') . '</span>';
            elseif ($order->status == 'approved')
                $status = '<span class="badge badge-primary">' . trans('layout.processing') . '</span>';
            elseif ($order->status == 'rejected')
                $status = '<span class="badge badge-danger">' . trans('layout.rejected') . '</span>';
            elseif ($order->status == 'ready_for_delivery')
                $status = '<span class="badge  badge-info">' . trans('layout.on_the_way') . '</span>';
            elseif ($order->status == 'delivered')
                $status = '<span class="badge badge-success">' . trans('layout.delivered') . '</span>';

            $newData[$key]['raw_status'] = $status;
            $newData[$key]['status'] = $order->status;
            $newData[$key]['action'] = "";
        }
        return response()->json(['data' => $newData, "draw" => 1,
            "recordsTotal" => $orders->count(),
            "recordsFiltered" => $orders->count()]);
    }

    public function printDetails(Request $request)
    {
        $data['order'] = $order = Order::with('details')->find($request->id);
        $data['currency'] = $order->restaurant->user->currency;
        if (!$order) return abort(404);

        $pdf = \PDF::loadView('pdf.order_details', $data);
        if ($request->type == 'pdf') {
            return $pdf->download(time() . '-order-' . $order->id . '.pdf');
        } else
            return $pdf->stream('order.pdf');

        //  return view('order.details', $data);
    }


//    payment related

// #section paypal
    public function processSuccess(Request $request)
    {
        $restaurant = Restaurant::find($request->restaurant);
        if (!$restaurant) abort(404);

        $credentials=get_restaurant_gateway_settings($restaurant->user_id);
        $credentials = isset($credentials->value)?json_decode($credentials->value):'';
        if (!isset($credentials->paypal_client_id) || !isset($credentials->paypal_secret_key) || !$credentials->paypal_client_id || !$credentials->paypal_secret_key) {
            return redirect()->route('show.restaurant', ['slug' => $restaurant->slug, 'id' => $restaurant->id])->withErrors(['msg' => trans('layout.message.invalid_payment')]);
        }
        $apiContext = $this->getPaypalApiContext($credentials->paypal_client_id, $credentials->paypal_secret_key);

        $paymentId = $request->paymentId;
        $order_id = $request->order;

        if (!$paymentId || !$order_id) {
            return redirect()->route('show.restaurant', ['slug' => $restaurant->slug, 'id' => $restaurant->id])->withErrors(['msg' => trans('layout.message.invalid_payment')]);
        }

        try {
            $payment = Payment::get($paymentId, $apiContext);
        } catch (\Exception $ex) {
            exit(1);
        }

        if (!$payment) return redirect()->route('show.restaurant', ['slug' => $restaurant->slug, 'id' => $restaurant->id])->withErrors(['msg' => trans('layout.message.invalid_payment')]);


        $url = $payment->getRedirectUrls();
        $parsed_url = parse_url($url->getReturnUrl());
        $query_string = $parsed_url["query"];
        parse_str($query_string, $array_of_query_string);

        if ($array_of_query_string["restaurant"] != $restaurant->id || $array_of_query_string["order"] != $order_id || $array_of_query_string['paymentId'] != $paymentId) {
            return redirect()->route('show.restaurant', ['slug' => $restaurant->slug, 'id' => $restaurant->id])->withErrors(['msg' => trans('layout.message.invalid_payment')]);
        }

        $order = Order::where(['id' => $order_id, 'restaurant_id' => $restaurant->id])->where(function ($q) use ($paymentId) {
            $q->whereNotIn('transaction_id', [$paymentId])->orWhereNull('transaction_id');
        })->first();

        if (!$order) {
            return redirect()->route('show.restaurant', ['slug' => $restaurant->slug, 'id' => $restaurant->id])->withErrors(['msg' => trans('layout.message.invalid_payment')]);
        }

        $order->payment_status = 'paid';
        $order->transaction_id = $paymentId;
        $order->save();

        return redirect()->route('show.restaurant', ['slug' => $restaurant->slug, 'id' => $restaurant->id])->with('order-success', trans('layout.message.order_placed'));

    }

    function paypalPayment($order, $rest)
    {
        $credentials=get_restaurant_gateway_settings($rest->user_id);
        $credentials = isset($credentials->value)?json_decode($credentials->value):'';
        if (!isset($credentials->paypal_client_id) || !isset($credentials->paypal_secret_key) || !$credentials->paypal_client_id || !$credentials->paypal_secret_key) {
            throw new \Exception(trans('layout.message.invalid_payment'));
        }
        $apiContext = $this->getPaypalApiContext($credentials->paypal_client_id, $credentials->paypal_secret_key);
        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new \PayPal\Api\Amount();
        $amount->setTotal($order->total_price);
        $amount->setCurrency(get_currency()); //TODO:: get the currency

        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);

        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl(route('order.payment.process.success', ['restaurant' => $rest->id, 'order' => $order->id]))
            ->setCancelUrl(route('show.restaurant', ['slug' => $rest->slug, 'id' => $rest->id]));

        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($apiContext);
            return $payment;
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            throw new \Exception($ex->getData());
        }

    }

    function getPaypalApiContext($client_id, $secret_key)
    {

        return new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $client_id,     // ClientID
                $secret_key      // ClientSecret
            )
        );
    }

// #endsection

    function stripePayment($order, $req)
    {
        $restaurant=Restaurant::find($order->restaurant_id);
        $credentials=get_restaurant_gateway_settings($restaurant->user_id);
        $credentials = isset($credentials->value)?json_decode($credentials->value):'';
        if (!isset($credentials->stripe_publish_key) || !isset($credentials->stripe_secret_key) || !$credentials->stripe_publish_key || !$credentials->stripe_secret_key) {
            throw new \Exception(trans('layout.message.invalid_payment'));
        }

        $stripe = new \Stripe\StripeClient($credentials->stripe_secret_key);

        return $stripe->charges->create([
            'amount' => $order->total_price * 100,
            'currency' => get_currency(),
            'source' => $req->stripeToken,
            'description' => 'Restaurant order placed',
        ]);
    }

    function payTmPayment($order){
        $restaurant=Restaurant::find($order->restaurant_id);
        $credentials=get_restaurant_gateway_settings($restaurant->user_id);
        $credentials = isset($credentials->value)?json_decode($credentials->value):'';
        if (!$credentials->paytm_environment || !$credentials->paytm_mid || !$credentials->paytm_secret_key || !$credentials->paytm_website || !$credentials->paytm_txn_url) {
            throw new \Exception(trans('layout.message.invalid_payment'));
        }

        $paytmParams = array();

        $orderId="ORDERID_".$order->id;
        $mid=$credentials->paytm_mid;
        $paytmParams["body"] = array(
            "requestType"   => "Payment",
            "mid"           => $mid,
            "websiteName"   => $credentials->paytm_website,
            "orderId"       => $orderId,
            "callbackUrl"   => route('payment.paytm.redirect-order'),
            "txnAmount"     => array(
                "value"     => $order->total_price,
                "currency"  => "INR",
            ),
            "userInfo"      => array(
                "custId"    => "CUST_".$order->user_id,
            ),
        );

        $checksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), $credentials->paytm_secret_key);

        $paytmParams["head"] = array(
            "signature"    => $checksum
        );
        $post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

        if($credentials->paytm_environment=='staging'){
            /* for Staging */
            $url = "https://securegw-stage.paytm.in/theia/api/v1/initiateTransaction?mid=".$mid."&orderId=".$orderId;

        }

        if($credentials->paytm_environment=='production' ){
            /* for Production */
            $url = "https://securegw.paytm.in/theia/api/v1/initiateTransaction?mid=".$mid."&orderId=".$orderId;

        }


        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        $response = curl_exec($ch);

        $response=json_decode($response);
        if(!isset($response->body) || !isset($response->body->resultInfo) || $response->body->resultInfo->resultStatus!='S'){
            throw new \Exception(trans('layout.message.invalid_payment'));
        }

        $data['response']=$response;
        $data['mid']=$mid;
        $data['order_id']=$orderId;
        return $data;

    }

    function processPaytmOrderRedirect(Request $request){

        if(!$request->ORDERID || !$request->TXNID || !$request->TXNAMOUNT || !$request->STATUS || !$request->CHECKSUMHASH){
            return redirect()->route('login')->withErrors(['msg' => trans('layout.message.invalid_payment')]);
        }
        $orderId=$request->ORDERID;
        $orderId=isset(explode('_',$orderId)[1])?explode('_',$orderId)[1]:'';

        $order=Order::find($orderId);
        if(!$order) return redirect()->route('login')->withErrors(['msg' => trans('layout.message.invalid_payment')]);

        $restaurant=Restaurant::find($order->restaurant_id);
        $credentials=get_restaurant_gateway_settings($restaurant->user_id);
        $credentials = isset($credentials->value)?json_decode($credentials->value):'';
        if (!$credentials->paytm_environment || !$credentials->paytm_mid || !$credentials->paytm_secret_key || !$credentials->paytm_website || !$credentials->paytm_txn_url) {
            throw new \Exception(trans('layout.message.invalid_payment'));
        }

        $paytmParams = $_POST;

        $paytmChecksum = $_POST['CHECKSUMHASH'];
        unset($paytmParams['CHECKSUMHASH']);

        $isVerifySignature = PaytmChecksum::verifySignature($paytmParams, $credentials->paytm_secret_key, $paytmChecksum);
        if(!$isVerifySignature) return redirect()->route('login')->withErrors(['msg' => trans('layout.message.invalid_payment')]);


        if($request->TXNAMOUNT!=format_number($order->total_price,2)) return redirect()->route('login')->withErrors(['msg' => trans('layout.message.invalid_payment')]);

        if($request->STATUS != 'TXN_SUCCESS') return redirect()->route('login')->withErrors(['msg' => trans('layout.message.cancel_payment')]);

        $order->transaction_id = $request->TXNID;
        $order->payment_status = 'paid';
        $order->save();

        return redirect()->route('show.restaurant', ['slug' => $restaurant->slug, 'id' => $restaurant->id])->with('order-success', trans('layout.message.order_placed'));

    }


}
