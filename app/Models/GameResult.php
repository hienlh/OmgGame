<?php

namespace OmgGame\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameResult extends Model
{
    use SoftDeletes;

    protected $dates = ['delete_at'];

    protected $fillable = [
        'game_id',
        'image',
        'design',
        'description'
    ];

    public function game()
    {
        return $this->belongsTo('OmgGame\Models\Game', 'game_id');
    }
}
