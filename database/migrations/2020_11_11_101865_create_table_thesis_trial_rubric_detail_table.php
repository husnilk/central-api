<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableThesisTrialRubricDetailTable extends Migration
{
    public function up()
    {
        Schema::create('thesis_rubric_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('thesis_rubric_id')->constrained();
            $table->text('description');
            $table->double('percentage')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('thesis_rubric_details');
    }
}
