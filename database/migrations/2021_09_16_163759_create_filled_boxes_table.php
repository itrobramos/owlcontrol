<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilledBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filled_boxes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger("userId")->unsigned()->nullable();
            $table->decimal('money',12,2);
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);

            $table->foreign('userId')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filled_boxes');
    }
}
