<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('nik')->unique();
            $table->string('name');
            $table->string('nip')->nullable();
            $table->string('karpeg')->nullable();
            $table->string('npwp')->nullable();
            $table->integer('gender')->nullable(); //code: config/central/gender
            $table->date('birthday')->nullable();
            $table->string('birthplace')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->foreignId('department_id')->nullable(); //code: table/Department/id
            $table->string('photo')->nullable();
            $table->integer('marital_status')->nullable(); //code: config/central/marital_status
            $table->integer('religion')->nullable(); //code: config/central/religion
            $table->integer('association_type')->nullable();
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
        Schema::dropIfExists('staff');
    }
}
