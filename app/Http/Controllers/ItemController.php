<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\OrderDetails;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ItemController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        if ($user->type == 'user') {
            $res_id = User::where('id',auth()->user()->id)->pluck('restaurant_id');
            $data['items']= Item::where('user_id',$res_id)->get();
            return view('item.index',$data);
        }
        elseif ($user->type == 'admin') {
            $data['items']= Item::get();
            return view('item.index', $data);
        }
        else
        {
            $data['items'] = auth()->user()->items;
            return view('item.index', $data);
        }   
    }

    public function create()
    {
        $data['restaurants'] = auth()->user()->active_restaurants;
        $data['categories'] = auth()->user()->active_categories;

        $data['extend_message'] = '';

        $user = auth()->user();
        if ($user->type != 'admin') {
            $userPlan = isset($user->current_plans[0]) ? $user->current_plans[0] : '';
            $userItems = $user->items()->count();
            if (!$userPlan || $userItems >= $userPlan->item_limit) {
                $data['extend_message']=trans('layout.item_extends');
            }
        }

        return view('item.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            "restaurant_id" => "required",
            "category_id" => "required",
            "name" => "required",
            "price" => "required | numeric|gt:-1",
            "discount_to" => "in:everyone,premium",
            "discount" => "numeric|gt:-1",
            "discount_type" => "in:flat,percent",
            "status" => "required|in:active,inactive",
            'item_image' => 'image'
        ]);
        $user = auth()->user();
        if ($user->type != 'admin') {
            $userPlan = isset($user->current_plans[0]) ? $user->current_plans[0] : '';
            $userItems = $user->items()->count();
            if (!$userPlan || $userItems >= $userPlan->item_limit) {
                return redirect()->back()->withErrors(['msg' => trans('layout.item_extends')]);
            }
        }

        if ($request->hasFile('item_image')) {
            $file = $request->file('item_image');
            $imageName = time() . '.' . $request->file('item_image')->getClientOriginalName();
            $file->move(public_path('/uploads'), $imageName);
            $request['image'] = $imageName;
        }
        $user->items()->create($request->all());

        return redirect()->route('item.index')->with('success', trans('layout.message.item_create'));

    }

    public function edit(Item $item)
    {
        $data['item'] = $item;
        $data['restaurants'] = auth()->user()->active_restaurants;
        $data['categories'] = auth()->user()->active_categories;
        return view('item.edit', $data);
    }
    
    public function search(Request $request) {
        $search = $_GET['search']; 
        $restaurant_id = $_GET['restaurant_id']; 
        $allItmes = Item::leftjoin('categories', 'categories.id', '=', 'items.category_id')
                    ->select('items.name as items_name','items.details as items_details','items.price as items_price','items.discount_type as discount_type','items.discount as discount','categories.name as category_name')
                    ->where('items.name', 'LIKE','%'.$search.'%')
                    ->where('items.restaurant_id', $restaurant_id)
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
    public function update(Request $request, Item $item)
    {
        $request->validate([
            "restaurant_id" => "required",
            "category_id" => "required",
            "name" => "required",
            "price" => "required | numeric|gt:-1",
            "discount_to" => "in:everyone,premium",
            "discount" => "numeric|gt:-1",
            "discount_type" => "in:flat,percent",
            "status" => "required|in:active,inactive",
            'item_image' => 'image'
        ]);

        if ($request->hasFile('item_image')) {

            $this->deleteItemImage($item);

            $file = $request->file('item_image');
            $imageName = time() . '.' . $file->extension();
            $file->move(public_path('/uploads'), $imageName);
            $request['image'] = $imageName;
        }

        $item->update($request->all());

        return redirect()->route('item.index')->with('success', trans('layout.message.item_update'));
    }


    public function destroy(Item $item)
    {
        $order_details = OrderDetails::where('item_id', $item->id)->first();
        if ($order_details) return redirect()->back()->withErrors(['msg' => trans('layout.message.item_not_delete')]);

        $this->deleteItemImage($item);

        $item->delete();
        return redirect()->back()->with('success', trans('layout.message.item_delete'));
    }

    function deleteItemImage(Item $item)
    {
        if ($item->image) {
            $fileN = public_path('uploads') . '/' . $item->image;
            if (File::exists($fileN))
                unlink($fileN);
        }
    }

}
