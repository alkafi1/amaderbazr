<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->integer('childcategory_id');
            $table->integer('brand_id');
            $table->string('name');
            $table->string('code');
            $table->string('unit')->nullable();
            $table->string('tags')->nullable();
            $table->string('thumnail')->nullable();
            $table->string('images')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('video')->nullable();
            $table->string('slug')->nullable();
            $table->string('purchase_price')->nullable();
            $table->string('selleing_price')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('stock_quantity')->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();
            $table->integer('warehouse')->nullable();
            $table->integer('featured')->default(0);
            $table->integer('todays_deals')->default(0);
            $table->integer('banner_slider')->default(0);
            $table->integer('pickup_point_id')->nullable();
            $table->date('date')->nullable();
            $table->string('month')->nullable();
            $table->integer('status')->default(0);
            $table->integer('cash_on_delivery')->default(0);
            $table->integer('added_by')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('sub_categories')->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
