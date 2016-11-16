<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model as Eloquent;

class ServiceCategory extends Eloquent
{
    protected $table = "s_categories";

    protected $fillable = ['name','desc'];


    public function services(){
        return $this->hasMany(CategoryServices::class,'s_category_id','id');
    }


}

