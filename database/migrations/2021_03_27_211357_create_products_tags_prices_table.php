<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTagsPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_tags_prices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("productId")->unsigned();
            $table->bigInteger("pricetagId")->unsigned();
            $table->decimal("price", 12, 2)->unsigned();
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });

        Schema::table('products_tags_prices', function (Blueprint $table){
            $table->foreign('productId')->references('id')->on('products');
            $table->foreign('pricetagId')->references('id')->on('price_tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_tags_prices');
    }
}
