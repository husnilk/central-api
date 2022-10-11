<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('course_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained();
            $table->integer('rev');
            $table->string('code');
            $table->text('name');
            $table->text('alias_name')->nullable();
            $table->integer('credit');
            $table->integer('semester');
            $table->integer('mandatory');
            $table->text('description')->nullable();
            $table->text('material')->nullable();
            $table->foreignId('created_by')->nullable()->constrained();
            $table->foreignId('validated_by')->nullable()->constrained();
            $table->timestamp('validated_at')->nullable();
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
        Schema::dropIfExists('course_plans');
    }
}
