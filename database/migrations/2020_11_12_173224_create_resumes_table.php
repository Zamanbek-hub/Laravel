<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('resume_text');
            $table->string('description');  
            $table->string('url_portfolio');  
            $table->integer('view_count');
            $table->integer('salary');
            $table->bigInteger('student_id')->unsigned();

            $table->foreign('student_id')
            ->references('id')
            ->on('students')
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
        Schema::dropIfExists('resumes');
    }
}
