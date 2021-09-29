<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\RoomItems;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderDetails;
use App\Models\Restaurant;

use Illuminate\Http\Request;

class KitchenOrderController extends Controller
{
    public function index(Request $request)
    {
        $user=auth()->user();
        if ($user->type == 'user') {
            $res_id = User::where('id',$user->id)->pluck('restaurant_id');
            $restaurants = Restaurant::where('user_id', $res_id)->pluck('id');
            $order =  Order::where('orders.status','=',"pending" )
                                    ->join('order_details as od','od.order_id','=','orders.id')
                                    ->join('items as item','item.id','=','od.item_id')
                                    ->join('tables as tb','tb.id','=','orders.table_id')
                                    ->whereIn('orders.restaurant_id', $restaurants)
                                    ->select('orders.id as id','orders.status as status','orders.user_id as user_id','orders.table_id as table_id','tb.name as table_name','orders.created_at as created_at','od.category_type as category_type','od.id as oid','item.name as item_name','orders.restaurant_id as restaurant_id','od.quantity as quantity');
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
            $order =  Order::where('orders.status','=',"approved" )
                                    ->join('order_details as od','od.order_id','=','orders.id')
                                    ->join('items as item','item.id','=','od.item_id')
                                    ->join('tables as tb','tb.id','=','orders.table_id')
                                    //->whereIn('orders.restaurant_id', $restaurants)
                                    ->select('orders.id as id','orders.status as status','orders.user_id as user_id','orders.table_id as table_id','tb.name as table_name','orders.created_at as created_at','od.category_type as category_type','item.name as item_name','od.id as oid','orders.restaurant_id as restaurant_id','od.quantity as quantity');
            if(!empty($type)){
                $order->where('category_type',$type);
            }
            $order = $order->orderBy('orders.created_at', 'desc')->get()->toArray();
            $data['orders'] =  $order;
        }
        else 
        {
            $restaurants = Restaurant::where('user_id', auth()->id())->pluck('id');
            $order =  Order::where('orders.status','=',"approved" )
                                    ->join('order_details as od','od.order_id','=','orders.id')
                                    ->join('items as item','item.id','=','od.item_id')
                                    ->join('tables as tb','tb.id','=','orders.table_id')
                                    ->whereIn('orders.restaurant_id', $restaurants)
                                    ->select('orders.id as id','orders.status as status','orders.user_id as user_id','orders.table_id as table_id','tb.name as table_name','orders.created_at as created_at','od.category_type as category_type','item.name as item_name','od.id as oid','orders.restaurant_id as restaurant_id','od.quantity as quantity');
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
        return view('kitchenorder.index', $data);
    }
    public function acceptkitchenorders()
    {
       $orderId = $_GET['orderId'];
       $result = Order::where('id',$orderId)->first();   
       if(!empty($result)){
        Order::where('id',$orderId)->update(array('status' => "delivered"));
       }
       return response()->json([
        'success'=>trans('layout.message.order_processed'),
        'failed'=>trans('layout.message.order_not_processed')

        ]);
    }
    

}
