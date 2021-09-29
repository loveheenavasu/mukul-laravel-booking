<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\RoomItems;
use App\Models\Restaurant;
use App\Models\RoomCategory;
use App\Models\Category;
use App\Models\OrderDetails;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Models\RestaurantVatSettings;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{

    public function index(){
        return view('front.index');
    }

    public function show($slug,Request $request)
    {
        $data['restaurant']= $restaurant=Restaurant::where('slug',$slug)->first();
        $data['rcategories']=RoomItems::with('category')
        ->where('restaurant_id',$restaurant->id)
        //->Where('status','active')
        ->get()->toArray();
        $coverImage = Slider::first();

        $data['custom_cover_image'] = array($coverImage->image_one,$coverImage->image_two,$coverImage->image_three);


        $data['hotel_slider'] = Slider::where('hotel_id',$restaurant->id)->get();

        return view('restaurant.show_restaurant',$data);
    }

    public function showRoomservice($slug,Request $request)
    {
        $data['restaurant']= $restaurant=Restaurant::where('slug',$slug)->first();
        if(!$restaurant) return abort(404);
        $room_categories=[];
        foreach ($restaurant->roomitems as $items){
            if($items->status == 'active'){
                if(!in_array($items->category,$room_categories)){
                    $room_categories[]=$items->category;
                }
            }

        }
        $data['my_orders']=OrderDetails::where('category_type','room')->get()->toArray();

        $data['room_categories'] = $room_categories;
        $data['restaurant_logo']=$restaurant->profile_image;
        $data['rcategories']=RoomItems::with('category')
        ->where('restaurant_id',$restaurant->id)
        //->Where('status','active')
        ->get()
        ->sortBy('created_at')
        ->groupBy(function ($roomitem,$key){
            return $roomitem->category->name;
        });

        $data['all_roomcategories'] = RoomCategory::where('user_id',$restaurant->user_id)->orderBy('created_at', 'ASC')->get()->toArray();

        $taxResult = RestaurantVatSettings::where('user_id',$restaurant->user_id)->first();
        if(!empty($taxResult)){
            $data['tax'] = json_decode($taxResult->value);
        }
        $data['tables']=$restaurant->tables;
        return view('restaurant.room_service',$data);
    }

    public function showFoodservice($slug,Request $request)
    {
        // dd($slug);
        $data['my_orders']=OrderDetails::where('category_type','food')->get()->toArray();

        // echo"<pre>"; print_r($data);
        $data['restaurant']= $restaurant=Restaurant::where('slug',$slug)->first();
        if(!$restaurant) return abort(404);

        $rest_categories=[];
        foreach ($restaurant->items as $item){
            if($item->status == 'active'){
                if(!in_array($item->category,$rest_categories)){
                    $rest_categories[]=$item->category;
                }
            }

        }
        $data['rest_categories'] = $rest_categories;
        $data['restaurant_logo']=$restaurant->profile_image;
        $data['categories']=Item::with('category')
        ->where('restaurant_id',$restaurant->id)
        // ->Where('status','active')
        ->get()
        ->sortBy('created_at')
        ->groupBy(function ($item,$key){
            return $item->category->name;
        });

        $data['all_categories'] = Category::where('user_id',$restaurant->user_id)->orderBy('created_at', 'ASC')->get()->toArray();

        $taxResult = RestaurantVatSettings::where('user_id',$restaurant->user_id)->first();
        if(!empty($taxResult)){
            $data['tax'] = json_decode($taxResult->value);
        }
        $data['tables']=$restaurant->tables;

        return view('restaurant.food_service',$data);
    }

    public function setLocale($type){
        $availableLang=get_available_languages();

        if(!in_array($type,$availableLang)) abort(400);

        session()->put('locale', $type);

        dd(session()->get('locale'));
        return redirect()->back();
    }
    function itemlinks($slug,Request $request)
    {
        $data['restaurant']= $restaurant=Restaurant::where('slug',$slug)->first();
        if(!$restaurant) return abort(404);
        $room_categories=[];
        foreach ($restaurant->roomitems as $items){
            if($items->status == 'active'){
                if(!in_array($items->category,$room_categories)){
                    $room_categories[]=$items->category;
                }
            }

        }
    }

}
