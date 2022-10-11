<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThesisProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thesis_proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('thesis_id');
            $table->timestamp('datetime');
            $table->unsignedBigInteger('room_id');
            $table->string('grade')->nullable();
            $table->foreignId('graded_by')->nullable();
            $table->integer('status')->default(0);
            $table->string('file_proposal')->nullable();
            $table->timestamps();

            $table->foreign('thesis_id')->references('id')->on('theses');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->foreign('graded_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thesis_proposals');
    }
}
