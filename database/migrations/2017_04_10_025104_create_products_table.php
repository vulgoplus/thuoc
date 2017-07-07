<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->integer('category_id')->unsigned()->index();
            $table->string('image');
            $table->text('images');
            $table->string('manufacture')->nullable();
            $table->bigInteger('price')->unsigned()->default(0);
            $table->biginteger('sale')->unsigned()->default(0);
            $table->tinyInteger('featured')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->string('tags')->nullable();
            $table->integer('view')->default(0)->unsigned();
            $table->integer('buy')->default(0)->unsigned();
            $table->string('slug');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
