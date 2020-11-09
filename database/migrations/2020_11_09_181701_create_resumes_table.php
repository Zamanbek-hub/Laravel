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
            $table->string('resume_text');
            $table->integer('view_count');
            $table->integer('salary');
            $table->string('description');  
            $table->string('url_portfolio');  
            $table->bigInteger('student_id')->unsigned();
            $table->timestamps();
            $table->foreign('student_id')
            ->references('id')
            ->on('students')
            ->onCascade('delete');
            // $table->timestamps('last_updated_date');
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
