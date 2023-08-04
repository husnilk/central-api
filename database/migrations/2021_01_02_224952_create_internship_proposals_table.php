<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternshipProposalsTable extends Migration
{
    public function up()
    {
        Schema::create('internship_proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->string('title');
            $table->text('background')->nullable();
            $table->text('purpose')->nullable();
            $table->text('planning')->nullable();
            $table->date('start_at');
            $table->date('end_at');
            $table->integer('status')->default(0);
            $table->text('note')->nullable();
            $table->integer('active')->default(1);
            $table->string('response_letter')->nullable();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('internship_companies');
        });
    }

    public function down()
    {
        Schema::dropIfExists('internship_proposals');
    }
}
