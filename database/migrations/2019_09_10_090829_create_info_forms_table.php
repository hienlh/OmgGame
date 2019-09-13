<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_forms', function (Blueprint $table) {
            $table->string('key', 50)->primary();
            $table->bigInteger('game_id')->unsigned()->index();
            $table->longText('name');
            $table->text('type');
            $table->longText('description');
            $table->longText('value');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
        });

        Schema::create('game_info_form', function (Blueprint $table) {
            $table->string('key', 50);
            $table->bigInteger('game_id')->unsigned();
            $table->primary(['key', 'game_id']);

            $table->foreign('key')->references('key')->on('info_forms')->onDelete('cascade');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_forms');
        Schema::dropIfExists('game_info_form');
    }
}
