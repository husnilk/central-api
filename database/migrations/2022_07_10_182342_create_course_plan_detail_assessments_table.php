<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursePlanDetailAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('course_plan_detail_assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_plan_detail_id')->constrained();
            $table->foreignId('course_plan_assessment_id')->constrained();
            $table->decimal('percentage', 8, 2);
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
        Schema::dropIfExists('course_plan_detail_assessments');
    }
}
