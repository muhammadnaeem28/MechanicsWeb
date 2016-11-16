<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model as Eloquent;

class BrandServices extends Eloquent
{
    protected $table = "s_brand_services";

    protected $fillable = ['s_brand_id','name','desc','price'];


    public function brand(){
        return $this->belongsTo(ServiceBrands::class,'s_brand_id');
    }



}

