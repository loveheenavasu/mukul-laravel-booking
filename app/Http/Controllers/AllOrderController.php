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
use Twilio\Rest\Client;
use App\Models\Table;
use App\Models\Setting;

class AllOrderController extends Controller
{
    public function index(Request $request, $type = '')
    {
        $user=auth()->user();
        if ($user->type == 'user') {
            $res_id = User::where('id',$user->id)->pluck('restaurant_id');
            $restaurants = Restaurant::where('user_id', $res_id)->pluck('id');
            $order =  Order::where('orders.status','=',"pending" )
                                    ->join('order_details as od','od.order_id','=','orders.id')
                                    ->leftjoin('items as item','item.id','=','od.item_id')
                                    ->leftjoin('roomitems as ritem','ritem.id','=','od.item_id')
                                    ->join('tables as tb','tb.id','=','orders.table_id')
                                    ->whereIn('orders.restaurant_id', $restaurants)
                                    ->select('orders.id as id','orders.status as status','orders.user_id as user_id','orders.table_id as table_id','tb.name as table_name','orders.created_at as created_at','od.category_type as category_type','od.id as oid','item.name as item_name','ritem.name as ritem_name','orders.restaurant_id as restaurant_id','od.quantity as quantity');
            if(!empty($type)){
                $order->where('category_type',$type);
            }
            $order = $order->orderBy('orders.created_at', 'desc')->get()->toArray();
            $data['orders'] =  $order;

        } else if ($user->type == 'customer') {
            $data['orders'] = Order::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        }
        else if ($user->type == 'admin') {
            //$restaurants = Restaurant::where('user_id', auth()->id())->pluck('id');
            $order =  Order::where('orders.status','=',"pending" )
                                    ->join('order_details as od','od.order_id','=','orders.id')
                                    ->leftjoin('items as item','item.id','=','od.item_id')
                                    ->leftjoin('roomitems as ritem','ritem.id','=','od.item_id')
                                    ->join('tables as tb','tb.id','=','orders.table_id')
                                   // ->whereIn('orders.restaurant_id', $restaurants)
                                    ->select('orders.id as id','orders.status as status','orders.user_id as user_id','orders.table_id as table_id','tb.name as table_name','orders.created_at as created_at','od.category_type as category_type','od.id as oid','item.name as item_name','ritem.name as ritem_name','orders.restaurant_id as restaurant_id','od.quantity as quantity');
            if(!empty($type)){
                $order->where('category_type',$type);
            }
            $order = $order->orderBy('orders.created_at', 'desc')->get()->toArray();
            $data['orders'] =  $order;

        } 
        else {
            $restaurants = Restaurant::where('user_id', auth()->id())->pluck('id');
            $order =  Order::where('orders.status','=',"pending" )
                                    ->join('order_details as od','od.order_id','=','orders.id')
                                    ->leftjoin('items as item','item.id','=','od.item_id')
                                    ->leftjoin('roomitems as ritem','ritem.id','=','od.item_id')
                                    ->join('tables as tb','tb.id','=','orders.table_id')
                                    ->whereIn('orders.restaurant_id', $restaurants)
                                    ->select('orders.id as id','orders.status as status','orders.user_id as user_id','orders.table_id as table_id','tb.name as table_name','orders.created_at as created_at','od.category_type as category_type','od.id as oid','item.name as item_name','ritem.name as ritem_name','orders.restaurant_id as restaurant_id','od.quantity as quantity');
            if(!empty($type)){
                $order->where('category_type',$type);
            }
            $order = $order->orderBy('orders.created_at', 'desc')->get()->toArray();
            $data['orders'] =  $order;

        }
        $orderData = [];
        foreach ($order as $orderdata) {
            $orderData[$orderdata['id']][]= $orderdata;
        }
        $data['orders'] = $orderData;
        return view('allorders.index', $data);
    }
    public function acceptorders()
    {
       $orderId = $_GET['orderId'];
       $result = Order::where('id',$orderId)->first();   
       if(!empty($result)){
        Order::where('id',$orderId)->update(array('status' => "approved"));
       }
       return response()->json([
        'success'=>trans('layout.message.order_accepted'),
        'failed'=>trans('layout.message.order_not_accepted')

        ]);
    }
    public function deleteorderItems()
    {
       $itemId = $_GET['itemId'];
       $result = OrderDetails::where('id',$itemId)->delete();
       return response()->json([
        'success'=>trans('layout.message.item_delete'),
        'failed'=>trans('layout.message.item_not_delete')

        ]);
    }
    public function deleteorders()
    {
       $orderId = $_GET['orderId'];
       
      $result = Order::where('id',$orderId)->first();
      if(!empty($result)){
        Order::where('id',$orderId)->update(array('status' => "rejected"));
       }
       return response()->json([
        'success'=>trans('layout.message.order_rejected'),
        'failed'=>trans('layout.message.order_not_rejected')

        ]);
    }

}
