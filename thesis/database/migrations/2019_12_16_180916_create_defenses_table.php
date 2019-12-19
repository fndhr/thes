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
            $table->unsignedBigInteger('usr_id');
            $table->dateTime('def_strt_dt');
            $table->dateTime('def_end_dt');
            $table->string('examiner');
            $table->string('chairman');
            $table->foreign('usr_id')->references('id')->on('users');
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
