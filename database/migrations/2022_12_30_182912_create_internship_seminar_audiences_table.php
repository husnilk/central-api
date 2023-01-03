<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internship_seminar_audiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('internship_id');
            $table->foreignId('student_id');
            $table->integer('attended')->default(1); //0 : Not Attended, 1 : Attended
            $table->integer('role')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('internship_id')->references('id')->on('internships');
            $table->foreign('student_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internship_seminar_audiences');
    }
};
