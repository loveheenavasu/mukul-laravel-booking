<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomCategory;
use App\Models\RoomItems;
use App\Models\User;

class RoomcategoryController extends Controller
{
    
    public function index(){
        $user = auth()->user();
        if ($user->type == 'user') {
            $res_id = User::where('id',$user->id)->pluck('restaurant_id');
            $data['rcategory']= RoomCategory::where('user_id',$res_id)->get();   
        }
        elseif ($user->type == 'admin') {
            $data['rcategory']=RoomCategory::get();
        }
        else
        {
            $data['rcategory']=RoomCategory::where('user_id',$user->id)->get();
        }
        return view('roomcategory.index',$data);
    }
    public function create(){
        return view('roomcategory.create');
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required|unique:roomcategory,name'
        ]);
        $request['user_id']=auth()->user()->id;
        RoomCategory::create($request->all());
        return redirect()->route('roomcategory.index')->with('success',trans('layout.message.room_category_store_msg'));
    }
    public function edit(RoomCategory $roomcategory){
        $data['roomcategory'] = $roomcategory;
        return view('roomcategory.edit',$data);
    }
    public function update(Request $request,RoomCategory $roomcategory){
        $request->validate([
            'name'=>'required',
        ]);
        $roomcategory->update($request->all());
        return redirect()->route('roomcategory.index')->with('success',trans('layout.message.room_category_update_message'));
    }
    public function destroy(RoomCategory $roomcategory){
        $item=RoomItems::where('category_id',$roomcategory->id)->first();
        if($item) return redirect()->back()->withErrors(['msg'=>trans('layout.message.category_not_delete')]);

        $roomcategory->delete();
        return redirect()->back()->with('success', trans('layout.message.room_category_delete'));
    }
}
