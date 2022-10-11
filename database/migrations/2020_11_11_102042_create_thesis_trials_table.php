<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThesisTrialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thesis_trials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('thesis_id');
            $table->foreignId('thesis_rubric_id');
            $table->string('file_report')->nullable();
            $table->string('file_slide')->nullable();
            $table->string('file_journal')->nullable();
            $table->integer('status')->default(0);
            $table->timestamp('registered_at');
            $table->integer('method')->default(1);
            $table->date('trial_at')->nullable();
            $table->time('start_at')->nullable();
            $table->time('end_at')->nullable();
            $table->foreignId('room_id')->nullable();
            $table->text('online_url')->nullable();
            $table->double('score')->nullable();
            $table->string('grade')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('thesis_id')->references('id')->on('theses');
            $table->foreign('thesis_rubric_id')->references('id')->on('thesis_rubrics');
            $table->foreign('room_id')->references('id')->on('rooms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thesis_trials');
    }
}
