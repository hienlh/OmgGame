<?php

namespace OmgGame\Models;

use Illuminate\Database\Eloquent\Model;

class InfoForm extends Model
{
    protected $fillable = [
        'game_id',
        'type',
        'name',
        'key',
        'description'
    ];

    public function game()
    {
        $this->belongsTo('OmgGame\Models\Game', 'game_id');
    }

    public function extra_infos()
    {
        $this->hasMany('OmgGame\Models\ExtraInfo', 'info_form_id', 'id');
    }
}
