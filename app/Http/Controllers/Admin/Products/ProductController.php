<?php

namespace App\Http\Controllers\Admin\Products;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\PickupPoint;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Str;
use Auth;
use Image;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    function product_create()
    {
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $childcategories = ChildCategory::all();
        $brands = Brand::all();
        $warehouses = Warehouse::all();
        $pickupopoints = PickupPoint::all();
        return view('admin.product.create',[
            'categories' => $categories,
            'subcategories' => $subcategories,
            'childcategories' => $childcategories,
            'brands' => $brands,
            'warehouses' => $warehouses,
            'pickupopoints' => $pickupopoints,
        ]);
    }
    //product store
    function product_store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'brand_id' => 'required',
            'name' => 'required',
            'code' => 'required',
            'unit' => 'required',
            'tags' => 'required',
            'description' => 'required',
            'stock_quantity' => 'required',
            'color' => 'required',
            'purchase_price' => 'required',
            'selleing_price' => 'required',
            'discount_price' => 'required',
        ]);
        $data = array();
        $data['category_id'] = $request->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['childcategory_id'] = $request->childcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['name'] = $request->name;
        $data['code'] = $request->code;
        $data['slug'] = Str::slug($request->name,'-');
        $data['unit'] = $request->unit;
        $data['stock_quantity'] = $request->stock_quantity;
        $data['purchase_price'] = $request->purchase_price;
        $data['selleing_price'] = $request->selleing_price;
        $data['discount_price'] = $request->discount_price;
        $data['pickup_point_id'] = $request->pickup_point_id;
        $data['warehouse'] = $request->warehouse_id;
        $data['featured'] = $request->featured;
        $data['todays_deals'] = $request->todays_deals;
        if($request->status){
            $data['status'] = $request->status;
        }
        $data['cash_on_delivery'] = $request->cash_on_delivery;
        $data['added_by'] =Auth::user()->id;
        $data['date'] = date('d-m-y');
        $data['month'] = date('F');
        $data['tags'] = $request->tags;
        $data['video'] = $request->video;
        $data['color'] = $request->color;
        $data['size'] = $request->size;
        $product_id = Product::insertGetId($data);
        if($request->thumbnail)
        {
            $thumbnail = $request->thumbnail;
            $extension = $thumbnail->getClientOriginalExtension();
            $image_name = $product_id.'-thumb-'.'.'.$extension;
            Image::make($thumbnail)->save(public_path('/uploads/product/thumbnail/').$image_name)->resize(300,300);
            // $data['thumnail'] = $image_name;
            $thumb = $image_name;
            Product::where('id',$product_id)->update([
                'thumnail' => $thumb,
            ]);
            
        }
        $images = array();
        if($request->hasFile('image'))
        {
            foreach($request->file('image') as $key=>$image)
            {
                $extension = $image->getClientOriginalExtension();
                $image_name = $product_id.'-image-'.$key.'.'.$extension;
                Image::make($image)->save(public_path('/uploads/product/image/').$image_name)->resize(300,300);
                array_push($images,$image_name);
            }
            Product::where('id',$product_id)->update([
                'images' => $images,
            ]);
        }
        $message = array('message' => 'Product Added Successfully.!',
            'alert-type' => 'success',       
                );
            return back()->with($message);
        
        
    }
    //index produict
    function index(Request $request)
    {
        if($request->ajax()){
            $products = Product::latest()->get();
            
            return DataTables::of($products)
            ->addIndexColumn()
            ->editColumn('category_name',function ($products){
                return $category_name = $products->reltocategory->name;
            })
            ->editColumn('subcategory_name',function ($products){
                return $subcategory_name = $products->reltosubcategory->subcategory_name;
            })
            ->editColumn('childcategory_name',function ($products){
                return $childcategory_name = $products->reltochildcategory->name;
            })
            ->editColumn('brand_name',function ($products){
                return $brand_name = $products->reltobrand->name;
            })
            ->editColumn('status',function ($products){
                if($products->status == 1){
                    return ' <button id="'.$products->id.'" class="btn btn-success status">Active</button>';
                }
                else{
                    return ' <button id="'.$products->id.'" class="btn btn-secondary status">Deactive</button>';
                }
            })
            ->editColumn('featured',function ($products){
                if($products->featured == 1){
                    return ' <button id="'.$products->id.'" class="btn btn-success featured">Yes</button>';
                }
                else{
                    return ' <button id="'.$products->id.'" class="btn btn-secondary featured">No</button>';
                }
            })
            ->editColumn('todays_deals',function ($products){
                if($products->todays_deals == 1){
                    return ' <button id="'.$products->id.'" class="btn btn-success todays_deals">Yes</button>';
                }
                else{
                    return ' <button id="'.$products->id.'" class="btn btn-secondary todays_deals">No</button>';
                }
            })
            ->addColumn('action', function($products){
                $action_btn = '<a href="" class="btn btn-info btn-sm" id="edit" data-id="'.$products->id.'"  data-toggle="modal" data-target="#editModal"> <i class="fas fa-edit"></i></a>
                
                <a href="'.route('coupon.delete',[$products->id]).'" class="btn btn-success btn-sm " id="delete_coupon"><i class="fas fa-eye"></i></a>
                <a href="'.route('product.delete',[$products->id]).'" class="btn btn-danger btn-sm mt-2" id="delete_product"><i class="fas fa-trash"></i></a>';
                return $action_btn;
            })
            ->rawColumns(['action','category_name','subcategory_name','childcategory_name','brand_name','status','featured','todays_deals'])
            ->make(true);
        }
        return view('admin.product.index');
    }
    //status change
    function product_status($id)
    {
        $product = Product::where('id',$id)->first();
        if($product->status == 1){
            $product->update([
                'status' => 0,
            ]);
        }
        else{
            $product->update([
                'status' => 1,
            ]);
        }
        return response()->json('Product Status Updated Successfully.!');
       
    }
    //featured change
    function product_featured($id)
    {
        $product = Product::where('id',$id)->first();
        if($product->featured == 1){
            $product->update([
                'featured' => 0,
            ]);
        }
        else{
            $product->update([
                'featured' => 1,
            ]);
        }
        return response()->json('Product Featured Updated Successfully.!');
       
    }
    //product_todays_deals change
    function product_todays_deals($id)
    {
        $product = Product::where('id',$id)->first();
        if($product->todays_deals == 1){
            $product->update([
                'todays_deals' => 0,
            ]);
        }
        else{
            $product->update([
                'todays_deals' => 1,
            ]);
        }
        return response()->json('Product Featured Updated Successfully.!');
       
    }
    //product Delete
    function product_delete($id)
    {
        $product = Product::where('id',$id)->delete();
        return response()->json('Product Delete Successfully!');
       
    }
    //get ajax child category
    function get_subcategory($id)
    {
        $subcategories = SubCategory::where('category_id',$id)->get();
        $str = '<option value="" disabled>--Select Sub Category --</option>';
        foreach($subcategories as $subcategory)
        {
            $str.=  '<option value="'.$subcategory->id.'">'.$subcategory->subcategory_name.'</option>"';
        }
        echo $str;
        
    }
    //get ajax child category
    function get_childcategory($id)
    {
        $childcategories = ChildCategory::where('subcategory_id',$id)->get();
        $str = '<option value="" disabled>--Select Child Category --</option>';
        foreach($childcategories as $childcategory)
        {
            $str.=  '<option value="'.$childcategory->id.'">'.$childcategory->name.'</option>"';
        }
        echo $str;
    }
    
}
