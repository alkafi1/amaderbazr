<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    function index()
    {
        $categories = Category::all();
        // $subcategories = SubCategory::all();
        // $childcategories = ChildCategory::all();
        $brands = Brand::all();
        return view('frontend.index',[
            'categories' => $categories,
            // 'subcategories' => $subcategories,
            // 'childcategories' => $childcategories,
            'brands' => $brands,
        ]);
    }
}
