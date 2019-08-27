<?php

namespace OmgGame\Helpers\Meta\Entities;

use OmgGame\Helpers\Meta\Traits\MetaEntity;
use Html;
use Illuminate\Support\HtmlString;

class MetaTag
{
    use MetaEntity;

    public function render()
    {
        if ($this->isEmpty()) return '';

        $attributes = array_merge(['name' => $this->name, 'content' => $this->content], $this->attributes);

        return new HtmlString('<meta' . Html::attributes($attributes) . '>' . PHP_EOL);
    }
}