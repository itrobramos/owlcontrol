<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('imageUrl')->nullable();
            $table->bigInteger("brandId")->unsigned();           
            $table->bigInteger("parentCategoryId")->unsigned()->nullable();           
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });

        Schema::table('categories', function (Blueprint $table){
            $table->foreign('brandId')->references('id')->on('brands');
            $table->foreign('parentCategoryId')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
