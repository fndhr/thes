<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('session_id')->primary();
            $table->dateTime('title_adv_req_start')->nullable();
            $table->dateTime('title_adv_req_end')->nullable();
            $table->dateTime('thesis_proposal_start')->nullable();
            $table->dateTime('thesis_proposal_end')->nullable();
            $table->dateTime('interim_report_start')->nullable();
            $table->dateTime('interim_report_end')->nullable();
            $table->dateTime('final_draft_start')->nullable();
            $table->dateTime('final_draft_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
