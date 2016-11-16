<?php
/**
 * Created by PhpStorm.
 * User: Speridian
 * Date: 6/26/2016
 * Time: 11:59 PM
 */

namespace App\Http\Controllers\API;

class CarModelTrimTransformer extends Transformer {


    public function transform($item){

        return [
            'id' => $item['id'],
            'name' => $item['name'],
            'trim' => $item['trim'],
            'year' => $item['year'],
            'brand' => $item['brand'],
            'desc' => $item['desc'],
            'image_url' => $item['image_url'],
            'year_id' => $item['year_id'],
            'brand_id' => $item['brand_id'],

        ];
    }
}