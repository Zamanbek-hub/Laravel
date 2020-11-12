<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacansySkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacansy_skills', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('skill_id')->unsigned();
            $table->bigInteger('vacancy_id')->unsigned();

            $table->foreign('skill_id')
            ->references('id')
            ->on('skills')
            ->onCascade('delete');
            $table->foreign('vacancy_id')
            ->references('id')
            ->on('vacancies')
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
        Schema::dropIfExists('vacansy_skills');
    }
}
