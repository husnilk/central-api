<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThesisSeminarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thesis_seminars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('thesis_id');
            $table->timestamp('registered_at')->nullable();
            $table->integer('method')->default(1);
            $table->timestamp('seminar_at')->nullable();
            $table->foreignId('room_id')->nullable();
            $table->text('online_url')->nullable();
            $table->string('file_report')->nullable();
            $table->string('file_slide')->nullable();
            $table->string('file_journal')->nullable();
            $table->string('file_attendance')->nullable();
            $table->integer('recommendation')->nullable();
            $table->integer('status')->default(0);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('thesis_id')->references('id')->on('theses');
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
        Schema::dropIfExists('thesis_seminars');
    }
}
