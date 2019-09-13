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
            $table->bigInteger('game_user_id')->unsigned();
            $table->string('key', 50);
            $table->longText('description');
            $table->longText('value');
            $table->timestamps();
            $table->softDeletes();

            $table->primary(['game_user_id', 'key']);

            $table->foreign('game_user_id')->references('id')->on('game_users')->onDelete('cascade');
            $table->foreign('key')->references('key')->on('info_forms');
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
