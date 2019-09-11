<?php

namespace OmgGame\Models;

use Illuminate\Database\Eloquent\Model;

class ResultCondition extends Model
{
    protected $fillable = [
        'result_id',
        'extra_info_id',
        'condition'
    ];

    public function game_result()
    {
        return $this->belongsTo('OmgGame\Models\GameResult', 'result_id');
    }

    public function extra_info()
    {
        return $this->belongsTo('OmgGame\Models\ExtraInfo', 'extra_info_id');
    }
}
