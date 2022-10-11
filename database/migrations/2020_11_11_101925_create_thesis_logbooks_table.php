<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThesisLogbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thesis_logbooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('thesis_id');
            $table->unsignedBigInteger('supervisor_id');
            $table->date('date');
            $table->text('progress');
            $table->text('problem')->nullable();
            $table->string('file_progress')->nullable();
            $table->unsignedBigInteger('supervised_by')->nullable();
            $table->timestamp('supervised_at')->nullable();
            $table->text('notes')->nullable();
            $table->string('file_notes')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();

            $table->foreign('thesis_id')->references('id')->on('theses');
            $table->foreign('supervisor_id')->references('id')->on('thesis_supervisors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('thesis_logbooks');
    }
}
