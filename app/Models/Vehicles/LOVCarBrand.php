<?php

namespace App\Models\Vehicles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model as Eloquent;

class LOVCarBrand extends Eloquent
{
    protected $table = "lov_car_brand";

    public function years(){
        return $this->belongsToMany(LOVCarYear::class,'c_brands_years','brand_id','year_id')
            ->withPivot('brand', 'year');
    }


}

