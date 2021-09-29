<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderDetails;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class UserDetailsController extends Controller
{
    public function index()
    {    
        $id = auth()->user()->id;
        $restaurantsID =Restaurant::where('user_id',$id)->pluck('id');
        $data['users'] = Order::join('order_details','order_details.order_id','=','orders.id')
        ->join('cust_order_whatsapp as cw','cw.id','=','orders.cust_phone_id')
        ->where('orders.restaurant_id',$restaurantsID)
        ->select('cw.whatsappnum as number','orders.name as name')
        ->groupBy('name')
        ->get();
        
        return view('userdetails.index',$data);
    }
}
