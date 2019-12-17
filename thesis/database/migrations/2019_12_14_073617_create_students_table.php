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
            $table->string('std_id')->primary();
            $table->unsignedBigInteger('major_id')->nullable();
            $table->unsignedBigInteger('title_id')->nullable();
            $table->string('lec_id')->nullable();
            $table->unsignedBigInteger('usr_id');
            $table->timestamps();
            $table->foreign('major_id')->references('major_id')->on('majors');
            $table->foreign('title_id')->references('title_id')->on('titles');
            $table->foreign('lec_id')->references('lec_id')->on('lecturers');
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
