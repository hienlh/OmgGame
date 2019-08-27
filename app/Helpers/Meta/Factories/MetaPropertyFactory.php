<?php

namespace OmgGame\Helpers\Meta\Factories;

use OmgGame\Helpers\Meta\Traits\MetaFactory;
use OmgGame\Helpers\Meta\Entities\MetaProperty;

class MetaPropertyFactory
{
    use MetaFactory;

    public function __construct()
    {
        $this->entity =  MetaProperty::class;
    }
}