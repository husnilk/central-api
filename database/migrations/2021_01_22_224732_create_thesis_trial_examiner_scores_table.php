<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThesisTrialExaminerScoresTable extends Migration
{
    public function up()
    {
        Schema::create('thesis_trial_examiner_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('thesis_trial_examiner_id');
            $table->foreignId('thesis_rubric_detail_id');
            $table->double('score')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('thesis_trial_examiner_id')->references('id')->on('thesis_trial_examiners');
            $table->foreign('thesis_rubric_detail_id')->references('id')->on('thesis_rubric_details');
        });
    }

    public function down()
    {
        Schema::dropIfExists('thesis_trial_examiner_scores');
    }
}
