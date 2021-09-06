<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpiryControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expiry_controls', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("productId")->unsigned();
            $table->bigInteger('entryId')->unsigned(1);
            $table->date('date');
            $table->boolean('available')->default(1);

            $table->foreign('productId')->references('id')->on('products');
            $table->foreign('entryId')->references('id')->on('entries');

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
        Schema::dropIfExists('expiry_controls');
    }
}
