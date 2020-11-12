<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialtyVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialty_vacancies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('vacancy_id')->unsigned();
            $table->bigInteger('specialty_id')->unsigned();

            $table->foreign('vacancy_id')
            ->references('id')
            ->on('vacancies')
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
        Schema::dropIfExists('specialty_vacancies');
    }
}
