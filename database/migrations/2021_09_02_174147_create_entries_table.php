<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("supplierId")->unsigned();
            $table->date("date")->nullable();
            $table->decimal('totalCost',12,2);
            $table->decimal('shipCost',12,2);
            $table->bigInteger("currencyId")->unsigned();
            $table->string('imageUrl')->nullable();


            $table->timestamps();
            $table->softDeletes('deleted_at', 0);


            $table->foreign('supplierId')->references('id')->on('suppliers');
            $table->foreign('currencyId')->references('id')->on('currencies');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entries');
    }
}
