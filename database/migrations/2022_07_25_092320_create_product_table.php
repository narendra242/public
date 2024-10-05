<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
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
            $table->string('title');
            $table->string('cat_id');
            $table->string('slug_url');
            $table->string('product_code')->nullable();
            $table->integer('brand_id')->nullable();
            $table->string('price')->nullable();
            $table->string('discount')->nullable();
            $table->string('quantity')->nullable();
            $table->string('searchkeyword')->nullable();
            $table->string('title_tag')->nullable();
            $table->string('canonical_tag')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();
            $table->text('short_desc')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('banner')->nullable();
            $table->string('alt_tag')->nullable();
            $table->string('tag_related')->nullable();
            $table->string('color_related')->nullable();
            $table->string('embed_video')->nullable();
            $table->string('rel_product')->nullable();
            $table->tinyInteger('featured_product')->default(0);
            $table->tinyInteger('arrival_product')->default(0);
            $table->integer('sort_order')->nullable();
            $table->tinyInteger('status')->default(0);  
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
}
