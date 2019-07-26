<?php

namespace OmgGame\Models;

use Illuminate\Database\Eloquent\Model;

class GameUser extends Model
{
    protected $fillable = [
        'game_id',
        'name',
        'email',
        'avatar',
        'last_play'
    ];

    public function game()
    {
        return $this->belongsTo('OmgGame\Models\Game', 'game_id');
    }
}
