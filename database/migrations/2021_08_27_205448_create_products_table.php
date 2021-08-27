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
            $table->id();
            $table->integer("SKU")->nullable();
            $table->string('name',255)->nullable();
            $table->string('internal_name',255)->nullable();
            $table->string('description',400)->nullable();
            $table->string('imageUrl')->nullable();
            $table->integer('stock')->default(0);
            $table->integer('value')->default(1);

            $table->bigInteger("productTypeId")->unsigned();
            $table->bigInteger("thematicId")->unsigned()->nullable();   

            $table->timestamps();
            $table->softDeletes('deleted_at', 0);

            $table->foreign('productTypeId')->references('id')->on('product_types');
            $table->foreign('thematicId')->references('id')->on('thematics');
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
