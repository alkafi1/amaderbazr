<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class CategoryCOntroller extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    //all category showing
    function index()
    {
        $categories = Category::all();
        return view('admin.category.category.index',[
            'categories' => $categories,
        ]);
    }
    //category srore
    function category_store(Request $request)
    {
        // return $request->all();
        if($request->image){
            $request->validate([
            'name'=>'unique:categories|required',
            'image'=>'mimes:jpg,png',
            'image'=>'file|max:1024',
            ]);
            $category_id = Category::insertGetId([
            'name'=> $request->name,
            'slug'=> Str::slug($request->name, '-'),
            'created_at' => Carbon::now(),
            ]);
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $image_name = $category_id.'.'.$extension;
            Image::make($image)->save(public_path('/uploads/categories/category/').$image_name)->resize(150,150);
            Category::find($category_id)->update([
                'image'=> $image_name,
            ]);
            $message = array('message' => 'Category Added Successfully.!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }
        else
        {
            $request->validate([
            'name'=>'unique:categories|required',
            ]);
            $category_id = Category::insertGetId([
            'name'=> $request->name,
            'slug'=> Str::slug($request->name, '-'),
            'created_at' => Carbon::now(),
            ]);
            $message = array('message' => 'Category Added Successfully.!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }
    }
    function category_delete($category_id)
    {
        $category_info = Category::find($category_id);
        if($category_info->image == ''){
            Category::find($category_id)->forceDelete();
            $message = array('message' => 'Category Delete Successfully.!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }
        else
        {
            $image_path = public_path('/uploads/categories/category/'.$category_info->image);
            unlink($image_path);
            Category::find($category_id)->forceDelete();
            $message = array('message' => 'Category Delete Successfully.!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }
    }
    function category_edit($id)
    {
        $category_info = Category::find($id);
        return $category_info;
    }
    function category_update(Request $request)
    {
        // return $request->all();
        
        if($request->image){
            // $request->validate([
            // 'name'=>'unique:categories|required',
            // ]);
            //delete image
            $category_info = Category::where('id',$request->id)->first();
            $image_path = public_path('/uploads/categories/category/'.$category_info->image);
            unlink($image_path);
            $category_id = Category::where('id',$request->id)->update([
            'name'=> $request->name,
            'slug'=> Str::slug($request->name, '-'),
            'created_at' => Carbon::now(),
            ]);
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $image_name = $category_id.'.'.$extension;
            Image::make($image)->save(public_path('/uploads/categories/category/').$image_name)->resize(150,150);
            Category::find($request->id)->update([
                'image'=> $image_name,
            ]);
            $message = array('message' => 'Category Added Successfully.!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }
        else
        {
            $request->validate([
            'name'=>'unique:categories|required',
            ]);
            $category_id = Category::where('id',$request->id)->update([
            'name'=> $request->name,
            'slug'=> Str::slug($request->name, '-'),
            'created_at' => Carbon::now(),
            ]);
            $message = array('message' => 'Category Save Successfully.!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }
    }
}
