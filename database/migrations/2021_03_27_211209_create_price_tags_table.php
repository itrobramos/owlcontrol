<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_tags', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("brandId")->unsigned();
            $table->string("name");
            $table->softDeletes('deleted_at', 0);
            $table->timestamps();
        });

        Schema::table('price_tags', function (Blueprint $table){
            $table->foreign('brandId')->references('id')->on('brands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_tags');
    }
}
