<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoringTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scoring_tables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('final_report_total');
            $table->integer('presentation_total');
            $table->integer('supervisor_total')->default(0);
            $table->string('std_id');
            $table->string('lec_id');
            $table->string('suggestion');
            $table->string('correction');
            $table->foreign('std_id')->references('std_id')->on('students');
            $table->foreign('lec_id')->references('lec_id')->on('lecturers');
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
        Schema::dropIfExists('scoring_tables');
    }
}
