<?php

namespace OmgGame\Models;

use Illuminate\Database\Eloquent\Model;

class InfoForm extends Model
{
    protected $fillable = [
        'type',
        'name',
        'key',
        'description',
        'value'
    ];

    protected $primaryKey = 'key';
    protected $keyType = 'string';

    public function games()
    {
        $this->belongsToMany('OmgGame\Models\Game', 'game_info_form', 'key', 'game_id', 'key', 'id');
    }

    public function extra_infos()
    {
        $this->hasMany('OmgGame\Models\ExtraInfo', 'key', 'key');
    }
}
