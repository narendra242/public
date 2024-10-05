<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('owner')->nullable();
            $table->string('main_heading')->nullable();
            $table->string('sub_heading')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('emailto')->nullable();
            $table->string('phone')->nullable();
            $table->string('contact')->nullable();
            $table->string('weburl')->nullable();
            $table->string('gmap')->nullable();
            $table->string('whats_app')->nullable();
            $table->string('analytics')->nullable();
            $table->string('webmaster')->nullable();
            $table->string('chat_widget')->nullable(500);
            $table->string('open_hours')->nullable();
            $table->string('copyright')->nullable();
            $table->string('shipping')->nullable();
            $table->string('title_tag')->nullable();
            $table->string('canonical_tag')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('image')->nullable();
            $table->string('alt_tag')->nullable();
            $table->text('social_data')->nullable();
            $table->Integer('sort_order')->default(0);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('generals');
    }
}
