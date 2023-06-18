<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    function index()
    {
        $categories = Category::all();
        $products = Product::where('status',1)->get();
        $banner_products = Product::where('banner_slider',1)->get();
        // $subcategories = SubCategory::all();
        // $childcategories = ChildCategory::all();
        $brands = Brand::all();
        return view('frontend.index',[
            'categories' => $categories,
            // 'subcategories' => $subcategories,
            // 'childcategories' => $childcategories,
            'brands' => $brands,
            'products' => $products,
            'banner_products' => $banner_products,
        ]);
    }
    //product details
    function product_detail($id)
    {
        $product = Product::where('id',$id)->first();
        $categories = Category::all();
        return view('frontend.product_detail',[
            'categories' => $categories,
            'product' => $product,
        ]);
    }
}
