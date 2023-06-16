<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    function reltocategory()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    function reltosubcategory()
    {
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }
    function reltochildcategory()
    {
        return $this->belongsTo(ChildCategory::class,'childcategory_id');
    }
    function reltobrand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }
}
