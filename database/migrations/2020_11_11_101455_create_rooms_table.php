<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id');
            $table->string('name');
            $table->integer('number')->nullable();
            $table->integer('floor')->nullable();
            $table->integer('capacity')->nullable();
            $table->integer('size')->nullable();
            $table->point('location')->nullable();
            $table->integer('status')->default(1); //1 - can be used / 0 - can't be used
            $table->timestamps();

            $table->foreign('building_id')->references('id')->on('buildings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
