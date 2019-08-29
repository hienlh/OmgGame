<?php

namespace OmgGame\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use SoftDeletes;
    protected $dates = ['delete_at'];
    protected $fillable = [
        'is_active',
        'name',
        'user_id',
        'question',
        'description',
        'image'
    ];

    public function results()
    {
        return $this->hasMany('OmgGame\Models\GameResult', 'game_id', 'id');
    }

    public function users()
    {
        return $this->hasMany('OmgGame\Models\GameUser', 'game_id', 'id');
    }

    public function owner()
    {
        return $this->belongsTo('OmgGame\Models\User');
    }
}
