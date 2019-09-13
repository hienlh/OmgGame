<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_conditions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('result_id')->unsigned()->index();
            $table->string('key', 50);
            $table->longText('condition');
            $table->string('operator', 10);
            $table->timestamps();

            $table->foreign('result_id')->references('id')->on('game_results')->onDelete('cascade');
            $table->foreign('key')->references('key')->on('info_forms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('result_conditions');
    }
}
