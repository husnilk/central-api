<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('class_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('study_plan_id')->constrained();
            $table->foreignId('class_meeting_id')->constrained();
            $table->string('device_id')->nullable();
            $table->string('device_name')->nullable();
            $table->double('lattitude')->nullable();
            $table->double('longitude')->nullable();
            $table->integer('attendance_status')->default(0);
            $table->integer('need_attention')->default(0);
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
        Schema::dropIfExists('class_attendances');
    }
}
