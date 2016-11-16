<?php

namespace App\Http\Controllers\API;


abstract Class Transformer {

    public function transformCollection(array $items)
    {

        return array_map([$this, 'transform'], $items);
    }



    public abstract function transform($item);




}


