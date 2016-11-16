<?php
/**
 * Created by PhpStorm.
 * User: Speridian
 * Date: 6/26/2016
 * Time: 11:59 PM
 */

namespace App\Http\Controllers\API;

class CategoryServicesTransformer extends Transformer {


    public function transform($item){

        return [
            'id' => $item['id'],
            'category_id' => $item['s_category_id'],
            'name' => $item['name'],
            'desc' => $item['desc'],
            'image_url' => $item['image_url'],

        ];
    }
}