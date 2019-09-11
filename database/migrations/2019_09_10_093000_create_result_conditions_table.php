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
            $table->bigInteger('result_id')->unsigned()->index();
            $table->bigInteger('extra_info_id')->unsigned()->index();
            $table->longText('condition');
            $table->timestamps();

            $table->primary(['result_id', 'extra_info_id']);
            $table->foreign('result_id')->references('id')->on('game_results')->onDelete('cascade');
            $table->foreign('extra_info_id')->references('id')->on('extra_infos')->onDelete('cascade');
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
