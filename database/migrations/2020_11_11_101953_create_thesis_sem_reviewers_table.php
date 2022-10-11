<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThesisSemReviewersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thesis_seminar_reviewers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('thesis_seminar_id');
            $table->foreignId('reviewer_id');
            $table->integer('status')->default(1);
            $table->string('position')->nullable();
            $table->integer('recomendation')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('thesis_seminar_id')->references('id')->on('thesis_seminars');
            $table->foreign('reviewer_id')->references('id')->on('lecturers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thesis_seminar_reviewers');
    }
}
