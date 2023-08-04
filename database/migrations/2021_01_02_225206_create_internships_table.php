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
            $table->foreignId('supervisor_id')->nullable();
            $table->integer('status')->default(0);
            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();

            $table->text('report_title')->nullable();
            $table->text('division')->nullable();
            $table->date('seminar_date')->nullable();
            $table->foreignId('seminar_room_id')->nullable();
            $table->string('link_seminar')->nullable();
            $table->date('seminar_deadline')->nullable();
            $table->date('final_report_deadline')->nullable();
            $table->string('field_score')->nullable();
            $table->text('seminar_report')->nullable();
            $table->string('final_grade')->nullable();
            $table->string('file_attendees_list')->nullable();
            $table->string('file_seminar_report')->nullable();
            $table->string('file_logbook_report')->nullable();
            $table->string('file_final_report')->nullable();
            $table->string('file_certificate')->nullable();
            $table->string('file_report_receipt')->nullable();
            $table->string('file_field_grade')->nullable();
            $table->timestamps();

            $table->foreign('seminar_room_id')->references('id')->on('rooms');
            $table->foreign('proposal_id')->references('id')->on('internship_proposals');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('supervisor_id')->references('id')->on('lecturers');
        });
    }

    public function down()
    {
        Schema::dropIfExists('internships');
    }
}
