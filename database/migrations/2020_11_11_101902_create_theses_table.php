<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThesesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('theses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('topic_id');
            $table->foreignId('student_id');
            $table->text('title')->nullable();
            $table->text('abstract')->nullable();
            $table->date('start_at')->nullable();
            $table->integer('status')->default(0);
            $table->string('grade')->nullable();
            $table->foreignId('grade_by')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();

            $table->foreign('topic_id')->references('id')->on('thesis_topics');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('theses');
    }
}
