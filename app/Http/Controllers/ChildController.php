<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Str;
use Image;

class ChildController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    //all subcategory showing
    function index(Request $request)
    {
        
        if($request->ajax()){
            // $childcategories = ChildCategory::leftJoin('categories','child_categories.category_id','categories.id')
            // ->leftJoin('sub_categories','child_categories.subcategory_id','sub_categories.id')
            // ->select('categories.name','sub_categories.subcategory_name','child_categories.*')->get();
            
            $childcategories = ChildCategory::with('category','subcategory')->get();
            return DataTables::of($childcategories)
                                ->addIndexColumn()
                                ->addColumn('action', function($childcategoy){
                                    $action_btn = '<a href="" class="btn btn-info btn-sm" id="edit" data-id="'.$childcategoy->id.'"  data-toggle="modal" data-target="#editModal"> <i class="fas fa-edit"></i></a>
                                    <a href="'.route('childcategory.delete',$childcategoy->id).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>';
                                    return $action_btn;
                                })
                                ->addColumn('category', function ($category) {
                                    return $category->category->name;
                                })
                                ->addColumn('subcategory', function ($subcategory) {
                                    return $subcategory->subcategory->subcategory_name;
                                })
                                ->rawColumns(['action','category','subcategory'])
                                ->make(true);
            
        }
        $categories = Category::all();
        $subcategories = SubCategory::all();
        return view('admin.category.childcategory.index',[
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
        
    }
    //child category stoe
    function childcategory_store(Request $request)
    {
        // return $request->all();
        if($request->image){
            $request->validate([
            'name'=>'required',
            'subcategory_id'=>'required',
            'image'=>'mimes:jpg,png',
            'image'=>'file|max:1024',
            ]);
            $subcategory =SubCategory::where('id',$request->subcategory_id)->first();
            $childcategory_id = ChildCategory::insertGetId([
                'category_id' => $subcategory->category_id,
                'subcategory_id' => $request->subcategory_id,
                'name'=> $request->name,
                'slug'=> Str::slug($request->name, '-'),
                'created_at' => Carbon::now(),
            ]);
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $image_name = $childcategory_id.'.'.$extension;
            Image::make($image)->save(public_path('/uploads/categories/childcategory/').$image_name)->resize(150,150);
            ChildCategory::find($childcategory_id)->update([
                'image'=> $image_name,
            ]);
            $message = array('message' => 'ChildCategory Added Successfully.!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }
        else
        {
            $request->validate([
                'name'=>'required',
                'subcategory_id'=>'required',
            ]);
            $subcategory =SubCategory::where('id',$request->subcategory_id)->first();
            $subcategory_id = ChildCategory::insertGetId([
                'category_id' => $subcategory->category_id,
                'subcategory_id' => $request->subcategory_id,
                'name'=> $request->name,
                'slug'=> Str::slug($request->name, '-'),
                'created_at' => Carbon::now(),
            ]);
            $message = array('message' => 'ChildCategory Added Successfully.!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }
    }
    //sub ctaegory delte
    function childcategory_delete($id)
    {
        $childcategory_info = ChildCategory::find($id);
        if($childcategory_info->image == ''){
            ChildCategory::find($id)->forceDelete();
            $message = array('message' => 'ChildCategory Delete Successfully.!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }
        else
        {
            $image_path = public_path('/uploads/categories/childcategory/'.$childcategory_info->image);
            unlink($image_path);
            ChildCategory::find($id)->forceDelete();
            $message = array('message' => 'ChildCategory Delete Successfully.!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }
    }
    //get data frox edit by ajax
    function childcategory_edit($id)
    {
        $chilcategory_info = ChildCategory::find($id);
        $category_info = Category::all();
        // $subcategory_info = SubCategory::all();
        return view('admin.category.childcategory.edit',[
            // 'subcategory_info' => $subcategory_info,
            'category_info' => $category_info,
            'chilcategory_info' => $chilcategory_info,
        ]);
    }
    //upadte
    function childcategory_update(Request $request)
    {
        // return $request->all();
        
        if($request->image){
            $request->validate([
                'name'=>'required',
                'subcategory_id'=>'required',
                'image'=>'mimes:jpg,png',
                'image'=>'file|max:1024',
                ]);
            $childcategory_info = ChildCategory::where('id',$request->id)->first();
            $image_path = public_path('/uploads/categories/childcategory/'.$childcategory_info->image);
            unlink($image_path);
            $subcategory =SubCategory::where('id',$request->subcategory_id)->first();
            $subcategory_id = ChildCategory::where('id',$request->id)->update([
                'category_id' => $subcategory->category_id,
                'subcategory_id' => $request->subcategory_id,
                'name'=> $request->name,
                'slug'=> Str::slug($request->name, '-'),
                'created_at' => Carbon::now(),
            ]);
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $image_name = $subcategory_id.'.'.$extension;
            Image::make($image)->save(public_path('/uploads/categories/childcategory/').$image_name)->resize(150,150);
            ChildCategory::find($request->id)->update([
                'image'=> $image_name,
            ]);
            $message = array('message' => 'ChildCategory Updated Successfully.!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }
        else
        {
            $request->validate([
                'name'=>'required',
                'subcategory_id'=>'required',
                'image'=>'mimes:jpg,png',
                'image'=>'file|max:1024',
                ]);
            $subcategory =SubCategory::where('id',$request->subcategory_id)->first();
            $subcategory_id = ChildCategory::where('id',$request->id)->update([
                'category_id' => $subcategory->category_id,
                'subcategory_id' => $request->subcategory_id,
                'name'=> $request->name,
                'slug'=> Str::slug($request->name, '-'),
                'created_at' => Carbon::now(),
            ]);
            $message = array('message' => 'ChildCategory Save Successfully.!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }
    }
}
