<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunityServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community_services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('community_service_schema_id');
            $table->string('partner')->nullable();
            $table->integer('start_at')->nullable();
            $table->integer('fund_amount')->nullable();
            $table->string('proposal_file')->nullable();
            $table->string('report_file')->nullable();
            $table->timestamps();

            $table->foreign('community_service_schema_id')->references('id')->on('community_service_schemas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('community_services');
    }
}
