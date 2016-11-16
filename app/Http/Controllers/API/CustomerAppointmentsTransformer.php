<?php
/**
 * Created by PhpStorm.
 * User: Speridian
 * Date: 6/26/2016
 * Time: 11:59 PM
 */

namespace App\Http\Controllers\API;

class CustomerAppointmentsTransformer extends Transformer {


    public function transform($item){

        return [
            'id' => $item['id'],
            'car_id' => $item['car_id'],
            'status' => $item['status'],
            'payment_type' => $item['payment_type'],
            's_total_time' => $item['s_slot'],
            's_start_time' => $item['s_date'],

        ];
    }
}