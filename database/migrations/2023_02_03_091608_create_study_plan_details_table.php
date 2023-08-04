<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyPlanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('study_plan_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('study_plan_id')->constrained();
            $table->foreignId('class_id')->constrained('class_courses');
            $table->integer('status')->default(1);
            $table->integer('transcript')->default(1);
            $table->double('weight')->nullable();
            $table->string('grade')->nullable();
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
        Schema::dropIfExists('study_plan_details');
    }
}
