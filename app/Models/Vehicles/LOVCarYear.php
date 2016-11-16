<?php

namespace App\Models\Vehicles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model as Eloquent;

class LOVCarYear extends Eloquent
{
    protected $table = "lov_car_year";


    public function brands(){
        return $this->belongsToMany(LOVCarBrand::class,'c_brands_years','year_id','brand_id')
            ->withPivot('brand', 'year');

    }

}

