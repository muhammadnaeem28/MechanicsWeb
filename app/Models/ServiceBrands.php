<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model as Eloquent;

class ServiceBrands extends Eloquent
{
    protected $table = "s_brands";

    protected $fillable = ['s_id','name','price','desc'];


    public function services(){
        return $this->hasMany(BrandServices::class,'s_brand_id','id');
    }

    public function service(){
        return $this->belongsTo(CategoryServices::class,'s_id');
    }

}

