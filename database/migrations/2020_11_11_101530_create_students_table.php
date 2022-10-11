<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('nik')->nullable();
            $table->string('nim')->unique();
            $table->string('name');
            $table->integer('year')->nullable();
            $table->integer('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->foreignId('department_id')->nullable();
            $table->string('photo')->nullable();
            $table->bigInteger('marital_status')->nullable();
            $table->integer('religion')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();

            $table->primary('id');
            $table->foreign('id')->references('id')->on('users');
            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
