<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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

            $table->bigIncrements('id');
            $table->integer('category_id');
            $table->string('name')->comment('商品名');
            $table->integer('price')->comment('価格');
            $table->integer('quantity')->comment('数量');
            $table->string('size')->nullable()->comment('サイズ詳細');
            $table->string('information')->nullable()->comment('商品情報');
            $table->string('material')->nullable()->comment('素材');
            $table->string('image1')->comment('商品イメージ１');
            $table->string('image2')->nullable()->comment('商品イメージ２');
            $table->string('image3')->nullable()->comment('商品イメージ３');
            $table->string('image4')->nullable()->comment('商品イメージ４');
            $table->string('image5')->nullable()->comment('商品イメージ５');
            $table->string('image6')->nullable()->comment('商品イメージ６');
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
