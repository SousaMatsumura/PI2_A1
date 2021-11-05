<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_records', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->date('expiration_date')->nullable();
            $table->unsignedBigInteger('food_id');
            $table->foreign('food_id')->references('id')->on('foods');
            $table->foreignId('institution_id')->constrained();
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
        Schema::dropIfExists('food_records');
    }
}
