<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursePlanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('course_plan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_plan_id')->constrained();
            $table->integer('week');
            $table->text('material')->nullable();
            $table->text('method')->nullable();
            $table->integer('activity')->nullable();
            $table->integer('est_time')->nullable();
            $table->text('student_activity')->nullable();
            $table->text('grade_indicator')->nullable();
            $table->text('grade_criteria')->nullable();
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
        Schema::dropIfExists('course_plan_details');
    }
}
