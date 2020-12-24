<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('email');
            $table->string('phone_number');
            $table->string('description');
        //    $table->integer('spec_id');
            $table->integer('view_count');
            $table->integer('salary');
            $table->bigInteger('employer_id')->unsigned();
            $table->timestamps()->useCurrent();
            $table->foreign('employer_id')
            ->references('id')
            ->on('employers')
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
        Schema::dropIfExists('vacancies');
    }
}
