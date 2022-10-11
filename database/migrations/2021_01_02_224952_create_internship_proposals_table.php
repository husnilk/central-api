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
            $table->string('title');
            $table->date('start_at');
            $table->date('end_at');
            $table->foreignId('agencies_id');
            $table->enum('status',['diajukan','revisi','diperbaiki','ditolak','disetujui','diterima'])->nullable();
            $table->text('note')->nullable();
            $table->integer('active')->default(1);
            $table->string('response_letter')->nullable();
            $table->text('purpose')->nullable();
            $table->timestamps();

            $table->foreign('agencies_id')->references('id')->on('internship_agencies');
        });
    }

    public function down()
    {
        Schema::dropIfExists('internship_proposals');
    }
}
