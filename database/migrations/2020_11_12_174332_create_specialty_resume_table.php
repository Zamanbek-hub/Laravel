<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialtyResumeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialty_resume', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('resume_id')->unsigned();
            $table->bigInteger('specialty_id')->unsigned();

            $table->foreign('resume_id')
            ->references('id')
            ->on('resumes')
            ->onCascade('delete');
            $table->foreign('specialty_id')
            ->references('id')
            ->on('specialties')
            ->onCascade('delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specialty_resume');
    }
}
