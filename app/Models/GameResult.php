<?php

namespace OmgGame\Models;

use Illuminate\Database\Eloquent\Model;

class GameResult extends Model
{

    protected $fillable = [
        'game_id',
        'image',
        'result'
    ];

    public function game()
    {
        return $this->belongsTo('OmgGame\Models\Game', 'game_id');
    }
}
