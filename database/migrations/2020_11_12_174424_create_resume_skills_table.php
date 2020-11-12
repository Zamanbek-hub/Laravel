<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResumeSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resume_skills', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('skill_id')->unsigned();
            $table->bigInteger('resume_id')->unsigned();

            $table->foreign('skill_id')
            ->references('id')
            ->on('skills')
            ->onCascade('delete');
            $table->foreign('resume_id')
            ->references('id')
            ->on('resumes')
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
        Schema::dropIfExists('resume_skills');
    }
}
