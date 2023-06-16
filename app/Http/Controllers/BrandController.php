<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Image;
use Str;
class BrandController extends Controller
{
    //
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    //all brand showing
    function index(Request $request)
    {
        if($request->ajax()){
            $brnads = Brand::all();
            return DataTables::of($brnads)
                                ->addIndexColumn()
                                ->addColumn('action', function($brnads){
                                    $action_btn = '<a href="" class="btn btn-info btn-sm" id="edit" data-id="'.$brnads->id.'"  data-toggle="modal" data-target="#editModal"> <i class="fas fa-edit"></i></a>
                                    <a href="'.route('brand.delete',$brnads->id).'" class="btn btn-danger btn-sm" id="delete"><i class="fas fa-trash"></i></a>';
                                    return $action_btn;
                                })
                                
                                ->rawColumns(['action'])
                                ->make(true);
            
        }
        return view('admin.category.brand.index');
    }
    //brand store
    function brand_store(Request $request)
    {
        // return $request->all();
        if($request->image){
            $request->validate([
            'name'=>'required',
            'image'=>'mimes:jpg,png',
            'image'=>'file|max:1024',
            ]);
            $brand_id = Brand::insertGetId([
                'name'=> $request->name,
                'slug'=> Str::slug($request->name, '-'),
                'created_at' => Carbon::now(),
            ]);
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $image_name = $brand_id.'.'.$extension;
            Image::make($image)->save(public_path('/uploads/categories/brand/').$image_name)->resize(150,150);
            Brand::find($brand_id)->update([
                'image'=> $image_name,
            ]);
            $message = array('message' => 'Brand Added Successfully.!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }
        else
        {
            $request->validate([
                'name'=>'required',
            ]);
            $brand = Brand::insertGetId([
                'name'=> $request->name,
                'slug'=> Str::slug($request->name, '-'),
                'created_at' => Carbon::now(),
            ]);
            $message = array('message' => 'Brand Added Successfully!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }
    }
    //brand delete
    function brand_delete($id)
    {
        $brand_info = Brand::find($id);
        if($brand_info->image == ''){
            Brand::find($id)->forceDelete();
            $message = array('message' => 'Brand Delete Successfully.!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }
        else
        {
            $image_path = public_path('/uploads/categories/Brand/'.$brand_info->image);
            unlink($image_path);
            Brand::find($id)->forceDelete();
            $message = array('message' => 'Brand Delete Successfully.!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }
    }
    //get data frox edit by ajax
    function brand_edit($id)
    {
        $brand_info = Brand::find($id);
        // $subcategory_info = SubCategory::all();
        return view('admin.category.brand.edit',[
            'brand_info' => $brand_info,
        ]);
    }
    //upadte
    function brand_update(Request $request)
    {
        if($request->image){
            $request->validate([
                'name'=>'required',
                'image'=>'mimes:jpg,png',
                'image'=>'file|max:1024',
                ]);
            $brand_info = Brand::where('id',$request->id)->first();
            $image_path = public_path('/uploads/categories/brand/'.$brand_info->image);
            unlink($image_path);
            $subcategory_id = Brand::where('id',$request->id)->update([
                'name'=> $request->name,
                'slug'=> Str::slug($request->name, '-'),
                'created_at' => Carbon::now(),
            ]);
            $image = $request->image;
            $extension = $image->getClientOriginalExtension();
            $image_name = $subcategory_id.'.'.$extension;
            Image::make($image)->save(public_path('/uploads/categories/brand/').$image_name)->resize(150,150);
            Brand::find($request->id)->update([
                'image'=> $image_name,
            ]);
            $message = array('message' => 'Brand Updated Successfully.!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }
        else
        {
            $request->validate([
                'name'=>'required',
                'image'=>'mimes:jpg,png',
                'image'=>'file|max:1024',
                ]);
            $brand_id = Brand::where('id',$request->id)->update([
                'name'=> $request->name,
                'slug'=> Str::slug($request->name, '-'),
                'created_at' => Carbon::now(),
            ]);
            $message = array('message' => 'Brand Save Successfully.!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        }
    }
}
