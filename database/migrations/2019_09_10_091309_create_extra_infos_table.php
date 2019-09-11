<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('game_user_id')->unsigned()->index();
            $table->bigInteger('info_form_id')->unsigned()->index();
            $table->text('key');
            $table->longText('description');
            $table->longText('value');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('game_user_id')->references('id')->on('game_users')->onDelete('cascade');
            $table->foreign('info_form_id')->references('id')->on('info_forms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extra_infos');
    }
}
