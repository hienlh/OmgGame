<?php

namespace OmgGame\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExtraInfo extends Model
{
    use SoftDeletes;
    protected $dates = ['delete_at'];
    protected $fillable = [
        'game_user_id',
        'key',
        'description',
        'value'
    ];

    public function game_user()
    {
        return $this->belongsTo('OmgGame\Models\GameUser', 'game_user_id');
    }

    public function info_form()
    {
        return $this->belongsTo('OmgGame\Models\InfoForm', 'key');
    }
}
