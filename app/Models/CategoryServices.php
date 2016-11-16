<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model as Eloquent;

class CategoryServices extends Eloquent
{
    protected $table = "s_category_services";

    protected $fillable = ['s_category_id','name','price','desc'];


    public function category(){
        return $this->belongsTo(ServiceCategory::class,'s_category_id');
    }

    public function brands(){
        return $this->hasMany(ServiceBrands::class,'id','s_id');
    }

    public function optionals(){

        return $this->belongsToMany(OptionalServices::class,'services_optionals','s_id','os_id');
    }


}

