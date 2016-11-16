<?php
/**
 * Created by PhpStorm.
 * User: Speridian
 * Date: 6/26/2016
 * Time: 11:59 PM
 */

namespace App\Http\Controllers\API;

class ServiceCategoryTransformer extends Transformer {


    public function transform($item){

        return [
            'id' => $item['id'],
            'name' => $item['name'],
            'desc' => $item['desc'],
            'image_url' => $item['desc'],

        ];
    }
}