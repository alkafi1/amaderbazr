<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use Auth;
use Carbon\Carbon;

class SubCategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    //all subcategory showing
    function index()
    {
        //$categories = SubCategory::all();
         $subcategories = SubCategory::leftJoin('categories', 'sub_categories.category_id', '=', 'categories.id')
       ->select('sub_categories.*','categories.name')
       ->get();
       $categories = Category::all();
        return view('admin.category.subcategory.index',[
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }
    //sub category stoe
    function subcategory_store(Request $request)
    {
        //return $request->all();
        if($request->image){
            // $request->validate([
            // 'name'=>'unique:subcategories|required',
            // 'image'=>'mimes:jpg,png',
            // 'image'=>'file|max:1024',
            // ]);
            $subcategory_id = SubCategory::insertGetId([
                'category_id' => $request->category_id,
                'subcategory_name'=> $request->name,
                'slug'=> Str::slug($request->name, '-'),
                'created_at' => Carbon::now(),
            ]);
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $image_name = $subcategory_id.'.'.$extension;
            Image::make($image)->save(public_path('/uploads/categories/subcategory/').$image_name)->resize(150,150);
            SubCategory::find($subcategory_id)->update([
                'image'=> $image_name,
            ]);
            $message = array('message' => 'SubCategory Added Successfully.!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }
        else
        {
            // $request->validate([
            // 'name'=>'unique:categories|required',
            // ]);
            $subcategory_id = SubCategory::insertGetId([
                'category_id' => $request->category_id,
                'subcategory_name'=> $request->name,
                'slug'=> Str::slug($request->name, '-'),
                'created_at' => Carbon::now(),
            ]);
            $message = array('message' => 'SubCategory Added Successfully.!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }
    }
    //sub ctaegory delte
    function subcategory_delete($subcategory_id)
    {
        $subcategory_info = SubCategory::find($subcategory_id);
        if($subcategory_info->image == ''){
            SubCategory::find($subcategory_id)->forceDelete();
            $message = array('message' => 'SubCategory Delete Successfully.!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }
        else
        {
            $image_path = public_path('/uploads/categories/subcategory/'.$subcategory_info->image);
            unlink($image_path);
            SubCategory::find($subcategory_id)->forceDelete();
            $message = array('message' => 'SubCategory Delete Successfully.!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }
    }
    //get data frox edit by ajax
    function subcategory_edit($id)
    {
        $subcategory_info = SubCategory::find($id);
        $category_info = Category::all();
        return view('admin.category.subcategory.edit',[
            'subcategory_info' => $subcategory_info,
            'category_info' => $category_info,
        ]);
    }
    //upadte
    function subcategory_update(Request $request)
    {
        // return $request->all();
        
        if($request->image){
            $subcategory_info = SubCategory::where('id',$request->id)->first();
            $image_path = public_path('/uploads/categories/subcategory/'.$subcategory_info->image);
            unlink($image_path);
            $subcategory_id = SubCategory::where('id',$request->id)->update([
                'category_id' => $request->category_id,
                'subcategory_name'=> $request->name,
                'slug'=> Str::slug($request->name, '-'),
                'created_at' => Carbon::now(),
            ]);
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $image_name = $subcategory_id.'.'.$extension;
            Image::make($image)->save(public_path('/uploads/categories/subcategory/').$image_name)->resize(150,150);
            SubCategory::find($request->id)->update([
                'image'=> $image_name,
            ]);
            $message = array('message' => 'SubCategory Updated Successfully.!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }
        else
        {
            
            $subcategory_id = SubCategory::where('id',$request->id)->update([
                'category_id' => $request->category_id,
                'subcategory_name'=> $request->name,
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
