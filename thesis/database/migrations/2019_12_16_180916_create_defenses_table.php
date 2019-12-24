\<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('defenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('std_id');
            $table->dateTime('def_strt_dt');
            $table->dateTime('def_end_dt');
            $table->string('room');
            $table->string('examiner');
            $table->string('chairman');
            $table->foreign('std_id')->references('std_id')->on('students');
            $table->foreign('examiner')->references('lec_id')->on('lecturers');
            $table->foreign('chairman')->references('lec_id')->on('lecturers');
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
        Schema::dropIfExists('defenses');
    }
}
