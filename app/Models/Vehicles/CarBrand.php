<?php

namespace App\Models\Vehicles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model as Eloquent;

class CarBrand extends Eloquent
{
    protected $table = "c_brands";

    public function years(){
        return $this->belongsToMany(CarYear::class,'c_brand_year','brand_id','year_id');

    }



}

