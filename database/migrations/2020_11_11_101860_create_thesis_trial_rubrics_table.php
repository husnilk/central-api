<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThesisTrialRubricsTable extends Migration
{
    public function up()
    {
        Schema::create('thesis_rubrics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->integer('active')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('thesis_rubrics');
    }
}
