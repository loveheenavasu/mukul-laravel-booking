<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $user = auth()->user();
        if ($user->type == 'user') {
            $res_id = User::where('id',auth()->user()->id)->pluck('restaurant_id');
            $data['categories']= Category::where('user_id',$res_id)->get();
            //return view('category.index',$data);
        }
        elseif($user->type == 'admin') {
            $data['categories']= Category::get();
        }
        else{
            $data['categories']=Category::where('user_id',auth()->user()->id)->get();
            return view('category.index',$data);
        }
        
        return view('category.index',$data);
    }
    public function create(){
        return view('category.create');
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required',
        ]);
        $request['user_id']=auth()->user()->id;
        Category::create($request->all());
        return redirect()->route('category.index')->with('success',trans('layout.message.category_store_msg'));
    }
    public function edit(Category $category){
        $data['category']=$category;
        return view('category.edit',$data);
    }
    public function update(Request $request,Category $category){
        $request->validate([
            'name'=>'required',
        ]);
        $category->update($request->all());
        return redirect()->route('category.index')->with('success',trans('layout.message.category_update_message'));
    }
    public function destroy(Category $category){

        $item=Item::where('category_id',$category->id)->first();
        if($item) return redirect()->back()->withErrors(['msg'=>trans('layout.message.category_not_delete')]);

        $category->delete();
        return redirect()->back()->with('success', trans('layout.message.category_delete'));
    }
}
