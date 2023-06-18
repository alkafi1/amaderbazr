<?php

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\Offer\CouponController;
use App\Http\Controllers\Admin\PickupPointController;
use App\Http\Controllers\Admin\Products\ProductController;
use App\Http\Controllers\Admin\Setting\PageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryCOntroller;
use App\Http\Controllers\ChildCategory;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\Admin\Setting\SeoController;
use App\Http\Controllers\Admin\Setting\SMTPController;
use App\Http\Controllers\Admin\Setting\WebsiteController;
use App\Http\Controllers\Admin\WarehouseController;
use Illuminate\Support\Facades\Route;


Route::get('/admin-login', [LoginController::class, 'admin_login'])->name('admin.login');


Route::group(['middleware' => 'is_admin'], function(){
    //global 
    Route::get('product/get/subcategory/{id}',[ProductController::class,'get_subcategory']);
    Route::get('product/get/child/{id}',[ProductController::class,'get_childcategory']);

    //admin-login
    Route::get('/dashboard', [AdminHomeController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/logout', [AdminHomeController::class, 'logout'])->name('admin.logout');
    Route::get('/changepassword', [AdminHomeController::class, 'changepassword'])->name('admin.changepassword');
    Route::post('/password_update', [AdminHomeController::class, 'password_update'])->name('admin.password_update');

    //category
    Route::group(['prefix'=>'category'], function(){
        Route::get('/', [CategoryCOntroller::class, 'index'])->name('category.index');
        Route::post('/store', [CategoryCOntroller::class, 'category_store'])->name('category.store');
        Route::get('/delete/{id}', [CategoryCOntroller::class, 'category_delete'])->name('category.delete');
        Route::get('/edit/{id}', [CategoryCOntroller::class, 'category_edit']);
        Route::post('/update', [CategoryCOntroller::class, 'category_update'])->name('category.update');
    });

    //subcategory
    Route::group(['prefix'=>'subcategory'], function(){
        Route::get('/', [SubCategoryController::class, 'index'])->name('subcategory.index');
        Route::post('/store', [SubCategoryController::class, 'subcategory_store'])->name('subcategory.store');
        Route::get('/delete/{id}', [SubCategoryController::class, 'subcategory_delete'])->name('subcategory.delete');
        Route::get('/edit/{id}', [SubCategoryController::class, 'subcategory_edit']);
        Route::post('/update', [SubCategoryController::class, 'subcategory_update'])->name('subcategory.update');
    });

    //chaild category
    Route::group(['prefix'=>'childcategory'], function(){
        Route::get('/', [ChildController::class, 'index'])->name('childcategory.index');
        Route::post('/store', [ChildController::class, 'childcategory_store'])->name('childcategory.store');
        Route::get('/delete/{id}', [ChildController::class, 'childcategory_delete'])->name('childcategory.delete');
        Route::get('/edit/{id}', [ChildController::class, 'childcategory_edit']);
        Route::post('/update', [ChildController::class, 'childcategory_update'])->name('childcategory.update');
    });
    //brand category
    Route::group(['prefix'=>'brand'], function(){
        Route::get('/', [BrandController::class, 'index'])->name('brand.index');
        Route::post('/store', [BrandController::class, 'brand_store'])->name('brand.store');
        Route::get('/delete/{id}', [BrandController::class, 'brand_delete'])->name('brand.delete');
        Route::get('/edit/{id}', [BrandController::class, 'brand_edit']);
        Route::post('/update', [BrandController::class, 'brand_update'])->name('brand.update');
    });
    //warehouse
    Route::group(['prefix'=>'warehouse'], function(){
        Route::get('/', [WarehouseController::class, 'index'])->name('warehouse.index');
        Route::post('/store', [WarehouseController::class, 'warehouse_store'])->name('warehouse.store');
        Route::get('/delete/{id}', [WarehouseController::class, 'warehouse_delete'])->name('warehouse.delete');
        Route::get('/edit/{id}', [WarehouseController::class, 'warehouse_edit']);
        Route::post('/update/{id}', [WarehouseController::class, 'warehouse_update'])->name('warehouse.update');
    });
    //coupon
    Route::group(['prefix'=>'coupon'], function(){
        Route::get('/', [CouponController::class, 'index'])->name('coupon.index');
        Route::post('/store', [CouponController::class, 'coupon_store'])->name('coupon.store');
        Route::delete('/delete/{id}', [CouponController::class, 'coupon_delete'])->name('coupon.delete');
        Route::get('/edit/{id}', [CouponController::class, 'coupon_edit']);
        Route::post('/update/{id}', [CouponController::class, 'coupon_update'])->name('coupon.update');
    });
    //pickup point
    Route::group(['prefix'=>'pickuppoint'], function(){
        Route::get('/', [PickupPointController::class, 'index'])->name('pickuppoint.index');
        Route::post('/store', [PickupPointController::class, 'pickuppoint_store'])->name('pickuppoint.store');
        Route::delete('/delete/{id}', [PickupPointController::class, 'pickuppoint_delete'])->name('pickuppoint.delete');
        Route::get('/edit/{id}', [PickupPointController::class, 'pickuppoint_edit']);
        Route::post('/update/{id}', [PickupPointController::class, 'pickuppoint_update'])->name('pickuppoint.update');
    });

    //Settings 
    Route::group(['prefix'=>'setting'], function(){

        //seo setting
        Route::group(['prefix'=>'seo'], function(){
            Route::get('/', [SeoController::class, 'index'])->name('seo.index');
            Route::post('/update/{id}', [SeoController::class, 'seo_update'])->name('seo.update');
        });
        //smtp setting
        Route::group(['prefix'=>'smtp'], function(){
            Route::get('/', [SMTPController::class, 'index'])->name('smtp.index');
            Route::post('/update/{id}', [SMTPController::class, 'smtp_update'])->name('smtp.update');
        });
        //page setting
        Route::group(['prefix'=>'page'], function(){
            Route::get('/', [PageController::class, 'index'])->name('page.index');
            Route::get('/create', [PageController::class, 'page_create'])->name('page.create');
            Route::post('/store', [PageController::class, 'page_store'])->name('page.store');
            Route::get('/edit/{id}', [PageController::class, 'page_edit'])->name('page.edit');
            Route::post('/update/{id}', [PageController::class, 'page_update'])->name('page.update');
            Route::get('/delete/{id}', [PageController::class, 'page_delete'])->name('page.delete');
        });
        //website setting
        Route::group(['prefix'=>'website'], function(){
            Route::get('/', [WebsiteController::class, 'index'])->name('website.index');
            Route::post('/update/{id}', [WebsiteController::class, 'website_update'])->name('website.update');
        });
    });

    //product 
    Route::group(['prefix'=>'product'], function(){
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::get('/create', [ProductController::class, 'product_create'])->name('product.create');
        Route::post('/store', [ProductController::class, 'product_store'])->name('product.store');
        Route::delete('/delete/{id}', [ProductController::class, 'product_delete'])->name('product.delete');
        Route::get('/edit/{id}', [ProductController::class, 'product_edit'])->name('product.edit');
        Route::post('/update/{id}', [ProductController::class, 'product_update'])->name('product.update');
        Route::get('/status/{id}', [ProductController::class, 'product_status'])->name('product.status');
        Route::get('/featured/{id}', [ProductController::class, 'product_featured'])->name('product.featured');
        Route::get('/todays_deals/{id}', [ProductController::class, 'product_todays_deals'])->name('product.todays_deals');
    });
});