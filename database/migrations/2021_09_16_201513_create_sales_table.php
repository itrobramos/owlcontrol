<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->decimal('price',12,2);
            $table->bigInteger('saleOriginId')->nullable()->unsigned();
            $table->bigInteger("userId")->unsigned()->nullable();
            $table->bigInteger("clientId")->unsigned()->nullable();
            $table->bigInteger("filledBoxId")->unsigned();
            $table->string('delivery', 1000)->nullable();
            $table->string('comments', 1000)->nullable();


            $table->timestamps();

            $table->foreign('saleOriginId')->references('id')->on('sale_origins');
            $table->foreign('userId')->references('id')->on('users');
            $table->foreign('clientId')->references('id')->on('clients');
            $table->foreign('filledBoxId')->references('id')->on('filled_boxes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
