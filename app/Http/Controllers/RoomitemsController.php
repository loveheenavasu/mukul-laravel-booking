<?php

namespace App\Http\Controllers;
use App\Models\RoomItems;
use App\Models\OrderDetails;
use App\Models\RoomCategory;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class RoomitemsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->type == 'user') {
            $res_id = User::where('id',auth()->user()->id)->pluck('restaurant_id');
            $data['roomitem']= RoomItems::where('user_id',$res_id)->get();
            return view('roomitems.index',$data);
        }
        if ($user->type == 'admin') {
            $data['roomitem']= RoomItems::get();
            return view('roomitems.index', $data);
        }
        else
        {
            $data['roomitem'] = auth()->user()->roomitems;
            return view('roomitems.index', $data);
        }
    
    }

    public function create()
    {
        $data['restaurants'] = auth()->user()->active_restaurants;
        $data['roomcategories'] = auth()->user()->active_roomcategories;

        $data['extend_message'] = '';

        $user = auth()->user();
        if ($user->type != 'admin') {
            $userPlan = isset($user->current_plans[0]) ? $user->current_plans[0] : '';
            $userItems = $user->roomitems()->count();
            if (!$userPlan || $userItems >= $userPlan->item_limit) {
                $data['extend_message']=trans('layout.item_extends');
            }
        }

        return view('roomitems.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            "restaurant_id" => "required",
            "category_id" => "required",
            "service_type"=>"required",
            "name" => "required",
            "price" => "nullable",
            "discount_to" => "in:everyone,premium",
            "discount" => "nullable",
            "discount_type" => "in:flat,percent",
            "status" => "required|in:active,inactive",
            'item_image' => 'image'
        ]);
        $user = auth()->user();
        if ($user->type != 'admin') {
            $userPlan = isset($user->current_plans[0]) ? $user->current_plans[0] : '';
            $userItems = $user->roomitems()->count();
            if (!$userPlan || $userItems >= $userPlan->item_limit) {
                return redirect()->back()->withErrors(['msg' => trans('layout.item_extends')]);
            }
        }

        if ($request->hasFile('item_image')) {
            $file = $request->file('item_image');
            $imageName = time() . '.' . $file->extension();
            $file->move(public_path('/uploads'), $imageName);
            $request['image'] = $imageName;
        }
        $user->roomitems()->create($request->all());

        return redirect()->route('roomitems.index')->with('success', trans('layout.message.item_create'));

    }

    public function edit(RoomItems $roomitem)
    {
        $data['roomitem'] = $roomitem;
        $data['restaurants'] = auth()->user()->active_restaurants;
        $data['roomcategories'] = auth()->user()->active_roomcategories;
        return view('roomitems.edit', $data);
    }
    
    public function search(Request $request) {
        $search = $_GET['search']; 
        $restaurant_id = $_GET['restaurant_id']; 
        $allItmes = RoomItems::leftjoin('roomcategory', 'roomcategory.id', '=', 'roomitems.category_id')
                    ->select('roomitems.name as items_name','roomitems.details as items_details','roomitems.price as items_price','roomitems.discount_type as discount_type','roomitems.discount as discount','roomcategory.name as category_name')
                    ->where('roomitems.name', 'LIKE','%'.$search.'%')
                    ->where('roomitems.restaurant_id', $restaurant_id)
                    ->get();
                    
        if(count($allItmes) > 0){
             echo '<div class="category-item-wrapper catg-list category-search-result">
                        <div class="category-search">
                            <h3 class="header-text">Search Results</h3>
                        </div>';
            foreach ($allItmes as $key =>$result) {
                echo '<div class="row cat-box">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                             <div class="card">
                                <div class="card-body">
                                   <div class="new-arrival-product all-product restaurant-all-products">
                                      <div class="new-arrival-content w-100 pl-3 d-flex">
                                         <div class="food-items-sec w-100">
                                            <h4>'.$result->items_name.'</h4>
                                            <span class="d-block">'.$result->items_details.'</span>
                                            <ul class="star-rating d-none">
                                               <li><i class="fa fa-star"></i></li>
                                               <li><i class="fa fa-star"></i></li>
                                               <li><i class="fa fa-star"></i></li>
                                               <li><i class="fa fa-star-half-empty"></i></li>
                                               <li><i class="fa fa-star-half-empty"></i></li>
                                            </ul>
                                         </div>
                                         <div class="price-box d-flex justify-content-end align-items-end w-100">
                                         <div></div>
                                            <div class="price">
                                               '.formatNumberWithCurrSymbol($result->items_price).'
                                            </div>
                                            <div class="text-right">
                                               <button data-value="{&quot;name&quot;:&quot;Alferedo Pasta&quot;,&quot;id&quot;:3,&quot;price&quot;:200,&quot;details&quot;:&quot;An Italian sauce that is usually combined with fettuccine noodles.&quot;,&quot;discount&quot;:0,&quot;discount_type&quot;:&quot;flat&quot;,&quot;discount_to&quot;:&quot;everyone&quot;}" class="btn btn-xxs btn-info add-to-cart">+
                                               </button>
                                            </div>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                            </div>
                        </div>
                </div>';
            }
            '</div>';
        }else{
            echo '<div class="no_item_result">Nothing Found!</div>';
        }
    }
    public function update(Request $request, RoomItems $roomitem)
    {
        $request->validate([
            "restaurant_id" => "required",
            "category_id" => "required",
            "service_type"=>"required",
            "name" => "required",
            "price" => "nullable",
            "discount_to" => "in:everyone,premium",
            "discount" => "nullable",
            "discount_type" => "in:flat,percent",
            "status" => "required|in:active,inactive",
            'item_image' => 'image'
        ]);

        if ($request->hasFile('item_image')) {

            $this->deleteItemImage($roomitem);

            $file = $request->file('item_image');
            $imageName = time() . '.' . $file->extension();
            $file->move(public_path('/uploads'), $imageName);
            $request['image'] = $imageName;
        }
        $roomitem->update($request->all());

        return redirect()->route('roomitems.index')->with('success', trans('layout.message.item_update'));
    }


    public function destroy(RoomItems $roomitem)
    {

        $order_details = OrderDetails::where(['item_id'=>$roomitem->id,'category_type'=>'room'])->first();
        if ($order_details) return redirect()->back()->withErrors(['msg' => trans('layout.message.item_not_delete')]);

        $this->deleteItemImage($roomitem);

        $roomitem->delete();
        return redirect()->back()->with('success', trans('layout.message.item_delete'));
    }

    function deleteItemImage(RoomItems $roomitem)
    {
        if ($roomitem->image) {
            $fileN = public_path('uploads') . '/' . $roomitem->image;
            if (File::exists($fileN))
                unlink($fileN);
        }
    }

}
