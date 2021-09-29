<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\RoomItems;
use App\Models\Restaurant;
use App\Models\RoomCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\RestaurantVatSettings;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class AboutHotelController extends Controller
{
    public function index($slug,Request $request){
        $data['restaurant']= $restaurant=Restaurant::where('slug',$slug)->first();
        return view('abouthotel.index',$data);
    }
}
