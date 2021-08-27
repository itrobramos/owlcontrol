<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuration_boxes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("boxId")->unsigned();
            $table->bigInteger("productTypeId")->unsigned();
            $table->integer("quantity");
            $table->integer("value");
            $table->bigInteger("thematicId")->unsigned()->nullable();   
            $table->timestamps();
 
            $table->foreign('boxId')->references('id')->on('boxes');           
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
        Schema::dropIfExists('configuration_boxes');
    }
}
