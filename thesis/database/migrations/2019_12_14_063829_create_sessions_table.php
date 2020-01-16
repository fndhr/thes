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

            $table->dateTime('title_adv_req_end')->nullable();
            $table->dateTime('thesis_proposal_end')->nullable();
            $table->dateTime('interim_report_end')->nullable();
            $table->dateTime('final_draft_end')->nullable();
            $table->dateTime('signed_revised_doc_end_date')->nullable();
            $table->dateTime('finalized_doc_end_date')->nullable();
            $table->integer('minimum_consultation')->default(1);

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
