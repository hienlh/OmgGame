<?php

namespace OmgGame\Models;

use Illuminate\Database\Eloquent\Model;

class ResultCondition extends Model
{
    protected $fillable = [
        'result_id',
        'key',
        'condition',
        'operator'
    ];

    public function game_result()
    {
        return $this->belongsTo('OmgGame\Models\GameResult', 'result_id');
    }

    public function info_form()
    {
        return $this->belongsTo('OmgGame\Models\InfoForm', 'key');
    }
}
