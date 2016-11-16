<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model as Eloquent;

class CustomerCar extends Eloquent
{
    protected $table = "customer_cars";


/*    public function experiences(){
        return $this->hasMany(Experience::class,'c_id');
    }*/

}

