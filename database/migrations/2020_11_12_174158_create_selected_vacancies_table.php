<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelectedVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selected_vacancies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('response_text');  
            $table->boolean('seen_status');
            $table->bigInteger('vacancy_id')->unsigned();
            $table->bigInteger('resume_id')->unsigned();

            $table->foreign('vacancy_id')
            ->references('id')
            ->on('vacancies')
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
        Schema::dropIfExists('selected_vacancies');
    }
}
