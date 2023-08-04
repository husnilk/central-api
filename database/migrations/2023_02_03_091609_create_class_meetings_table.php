<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('class_meetings', function (Blueprint $table) {
            $table->id();
            $table->integer('meet_no');
            $table->foreignId('class_id')->constrained('class_courses');
            $table->foreignId('course_plan_detail_id')->constrained();
            $table->integer('method')->default(1);
            $table->string('ol_platform')->nullable();
            $table->string('ol_links')->nullable();
            $table->foreignId('room_id')->nullable()->constrained();
            $table->date('lecture_date')->nullable();
            $table->time('start_at')->nullable();
            $table->time('end_at')->nullable();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_meetings');
    }
}
