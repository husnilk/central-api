<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseLosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('course_los', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_plan_id')->constrained();
            $table->integer('type')->default('1');
            $table->string('code');
            $table->text('name');
            $table->foreignId('parent_id')->nullable()->constrained('course_los');
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
        Schema::dropIfExists('course_los');
    }
}
