<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model as Eloquent;

class OptionalServices extends Eloquent
{
    protected $table = "service_optionals";

    protected $fillable = ['name','price','desc'];

    public function services(){
        return $this->belongsToMany(CategoryServices::class,'services_optionals','s_id','os_id');
    }

}

