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
            $table->bigIncrements('std_id');
            $table->unsignedBigInteger('major_id');
            $table->unsignedBigInteger('title_id');
            $table->unsignedBigInteger('lec_id');
            $table->unsignedBigInteger('usr_id');
            $table->timestamps();
            $table->foreign('major_id')->references('major_id')->on('majors');
            $table->foreign('title_id')->references('title_id')->on('titles');
            $table->foreign('lec_id')->references('lec_id')->on('lectures');
            $table->foreign('usr_id')->references('id')->on('users');
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
