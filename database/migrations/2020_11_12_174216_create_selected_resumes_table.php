<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelectedResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selected_resumes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('request_text');  
            $table->boolean('seen_status');
            $table->bigInteger('resume_id')->unsigned();

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
        Schema::dropIfExists('selected_resumes');
    }
}
