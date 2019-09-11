<?php

namespace OmgGame\Models;

use Illuminate\Database\Eloquent\Model;

class GameUser extends Model
{
    protected $fillable = [
        'id',
        'name',
        'avatar',
        'last_play'
    ];

    public function games()
    {
        return $this->belongsToMany('OmgGame\Models\Game', 'user_play_game', 'game_user_id', 'game_id');
    }

    public function extra_infos()
    {
        return $this->hasMany('OmgGame\Models\ExtraInfo', 'game_user_id', 'id');
    }
}
