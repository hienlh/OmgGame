<?php
namespace OmgGame\Helpers\Meta\Factories;

use OmgGame\Helpers\Meta\Traits\MetaFactory;
use OmgGame\Helpers\Meta\Entities\MetaTag;

class MetaTagFactory
{
    use MetaFactory;

    public function __construct()
    {
        $this->entity =  MetaTag::class;
    }
}