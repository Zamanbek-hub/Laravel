<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('pnumber');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('region_id')->unsigned();

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onCascade('delete');
            $table->foreign('region_id')
            ->references('id')
            ->on('regions')
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
        Schema::dropIfExists('employers');
    }
}
