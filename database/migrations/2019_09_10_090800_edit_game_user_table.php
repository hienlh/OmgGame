<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditGameUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('game_users', function (Blueprint $table) {
            $table->dropForeign('game_users_game_id_foreign');
            $table->dropColumn('game_id');

            $table->string('id', 50)->change();
        });

        Schema::create('user_play_game', function (Blueprint $table) {
            $table->string('game_user_id', 50);
            $table->bigInteger('game_id')->unsigned()->index();

            $table->primary(['game_user_id', 'game_id']);
            $table->foreign('game_user_id')->references('id')->on('game_users')->onDelete('cascade');
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
        Schema::dropIfExists('user_play_game');

        Schema::table('game_users', function (Blueprint $table) {
            $table->bigInteger('game_id')->unsigned()->index()->default(1);
            $table->bigIncrements('id')->change();
        });

        Schema::table('game_users', function (Blueprint $table) {
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
        });
    }
}
