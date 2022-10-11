<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThesisTrialExaminersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thesis_trial_examiners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('thesis_trial_id');
            $table->unsignedBigInteger('examiner_id');
            $table->integer('status')->default(0);
            $table->integer('position')->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('examiner_id')->references('id')->on('lecturers');
            $table->foreign('thesis_trial_id')->references('id')->on('thesis_trials');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thesis_trial_examiners');
    }
}
