<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustOrderWhatsapp;
use App\Models\OrderDetails;
use App\Models\Item;
use App\Models\Order;
use DB;
use Response;

class OrderSearchController extends Controller
{
    public function orderSearch(Request $request){
        $results = [];
        $final_array = '';
        
        $cat_type=$request->cat_type;
        //echo $cat_type;die;
        $whatsapp = CustOrderWhatsapp::where('whatsappnum','=',$request->whatsappnum)->first();
        if(!empty($whatsapp)){
            $ordersArr = [];
            if($cat_type== 'room'){
                $orders = Order::where('cust_phone_id',$whatsapp->id)

                                ->join('order_details as od','od.order_id','=','orders.id')
                                ->join('roomitems as ritem','ritem.id','=','od.item_id')
                                ->where('od.category_type',$cat_type)
                                ->select('od.*','ritem.*','orders.user_id','orders.table_id','orders.restaurant_id','orders.status as dlivery_status','orders.payment_status as payment_status','od.category_type as cat_type','orders.delivered_within','orders.comment','orders.approved_at','orders.created_at as order_created')

                                ->get()->toArray();
                               
            }

            else
                {
                    $orders = Order::where('cust_phone_id',$whatsapp->id)
                        ->join('order_details as od','od.order_id','=','orders.id')
                        ->join('items as item','item.id','=','od.item_id')
                        ->where('od.category_type',$cat_type)
                        ->select('od.*','item.*','orders.user_id','orders.table_id','orders.restaurant_id','orders.status as dlivery_status','orders.payment_status as payment_status','od.category_type as cat_type','orders.delivered_within','orders.comment','orders.approved_at','orders.created_at as order_created')
                        ->get()->toArray();
                }
            
                    
            foreach ($orders as $key => $order) {
                $results[$order['order_id']][] = $order;
            }
        }
        if(!empty($results)){
            $final_array = '';
            foreach ($results as $key => $result) {
                $qty   = [];
                $totalPrice = [];
                $date1 = $result[0]['order_created'];
                $date2 = date('Y-m-d H:i:s');
                $seconds = strtotime($date2) - strtotime($date1);
                $hours = $seconds / 60 /  60;
                if($hours < 24){
                    $date = 'Today';
                }else{
                    $date = date("d/m/y", strtotime($result[0]['order_created']));
                }
                if($result[0]['payment_status'] == 'paid'){
                    $class = "paid-green-bnt";
                }else{
                    $class = "pending";
                }
                if($result[0]['dlivery_status'] == 'pending'){
                    $dlivery_status = 'prep-orange';
                }elseif($result[0]['dlivery_status'] == 'approved'){
                    $dlivery_status = 'prep-green';
                }elseif($result[0]['dlivery_status'] == 'ready_for_delivery'){
                    $dlivery_status = 'prep-blue';
                }elseif($result[0]['dlivery_status'] == 'delivered'){
                    $dlivery_status = 'prep-yellow';
                }else{
                    $dlivery_status = 'prep-red';
                }
                $final_array .= '<div class="order-table">
                                <table class="preparing-table w-100">
                                <tr class="prep-title">
                                <th class="order-no">order no. #'.$result[0]['order_id'].'</th>
                                <th class="today">'.$date.'</th>
                                <th class="'.$dlivery_status.'">
                                <i class="fa fa-clock-o"></i>'.$result[0]['dlivery_status'].'</th>
                                </tr>
                                <tr class="prep-amount">
                                    <td>items</td>
                                    <td>qty</td>
                                    <td>amount</td>
                                </tr>';
              
                foreach ($result as $key => $value) {
                    $final_array .= '<tr class="prep-list">
                                        <td>'.$value['name'].'</td>
                                        <td>'.$value['quantity'].'</td>
                                        <td>rs. '.$value['total'].'</td>
                                    </tr>';
                    $qty[] = $value['quantity'];
                    $totalPrice[] = $value['total'];
                }
                $final_array .= '<tr class="total">
                                    <td>total</td>
                                    <td>'.array_sum($qty).'</td>
                                    <td>rs.'.array_sum($totalPrice).'</td>
                                </tr>';
                $final_array .= '<tr>
                                    <td></td>
                                    <td></td>
                                    <td class="'.$class.'">'.$result[0]['payment_status'].'</td>
                                </tr>';
                $final_array .= '</table>
                                </div>';
            }
            return $final_array;
        }else{
            return [];
        }
    }
}
