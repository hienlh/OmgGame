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
        'question',
        'description',
        'image'
    ];

    public function results()
    {
        return $this->hasMany('OmgGame\Models\GameResults', 'game_id', 'id');
    }

    public function users()
    {
        return $this->hasMany('OmgGame\Models\GameUsers', 'game_id', 'id');
    }
}
