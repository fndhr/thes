<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposedTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposed_titles', function (Blueprint $table) {
            $table->bigIncrements('title_id');
            $table->string('title_name');
            $table->string('std_id');
            $table->unsignedBigInteger('sts_id')->default(1);
            $table->timestamps();
            $table->foreign('std_id')->references('std_id')->on('students');
            $table->foreign('sts_id')->references('sts_id')->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposed_titles');
    }
}
