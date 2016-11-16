<?php

namespace App\Models\Vehicles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model as Eloquent;

class CarYear
    extends Eloquent
{
    protected $table = "c_years";


    public function brands(){
        return $this->belongsToMany(CarBrand::class,'c_brand_year','year_id','brand_id');

    }

}

