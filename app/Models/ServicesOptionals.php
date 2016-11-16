<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model as Eloquent;

class ServicesOptionals extends Eloquent
{
    protected $table = "services_optionals";

    protected $fillable = ['name','s_id','os_id'];


}

