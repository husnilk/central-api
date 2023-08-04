<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassLecturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('class_lecturers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('class_courses');
            $table->foreignId('lecturer_id')->constrained();
            $table->integer('position')->default(1);
            $table->integer('grading')->default(1);
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_lecturers');
    }
}
