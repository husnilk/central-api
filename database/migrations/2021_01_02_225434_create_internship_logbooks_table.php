<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternshipLogbooksTable extends Migration
{
    public function up()
    {
        Schema::create('internship_logbooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('internship_id');
            $table->date('date');
            $table->text('activities')->nullable();
            $table->text('note')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();

            $table->foreign('internship_id')->references('id')->on('internships');
        });
    }

    public function down()
    {
        Schema::dropIfExists('internship_logbooks');
    }
}
