<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilledBoxesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filled_boxes_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("filledBoxId")->unsigned();
            $table->bigInteger("productId")->unsigned();
            $table->decimal('price',12,2);

            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
            
            $table->foreign('filledBoxId')->references('id')->on('filled_boxes');
            $table->foreign('productId')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filled_boxes_details');
    }
}
