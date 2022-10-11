<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternshipsTable extends Migration
{
    public function up()
    {
        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proposal_id');
            $table->foreignId('student_id');
            $table->foreignId('advisor_id')->nullable();
            $table->enum('status',['Diterima','Ditolak','Selesai','Dibatalkan','Sedang KP','Seminar','Berkas seminar tidak lengkap','Berkas seminar tidak sesuai','Seminar verified','Berkas KP tidak lengkap','Berkas KP tidak sesuai','Berkas KP verified','Selesai Praktek Lapangan'])->nullable();
            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();

            $table->text('report_title')->nullable();
            $table->date('seminar_date')->nullable();
            $table->foreignId('seminar_room_id')->nullable();
            $table->string('link_seminar')->nullable();
            $table->date('seminar_deadline')->nullable();
            $table->string('attendees_list')->nullable();
            $table->string('internship_score')->nullable();
            $table->string('activity_report')->nullable();
            $table->string('news_event')->nullable();
            $table->string('work_report')->nullable();
            $table->string('certificate')->nullable();
            $table->string('report_receipt')->nullable();
            $table->string('grade')->nullable();
            $table->timestamps();

            $table->foreign('seminar_room_id')->references('id')->on('rooms');
            $table->foreign('proposal_id')->references('id')->on('internship_proposals');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('advisor_id')->references('id')->on('lecturers');
        });
    }

    public function down()
    {
        Schema::dropIfExists('internships');
    }
}
