<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model as Eloquent;

class ServiceTime extends Eloquent
{
    protected $table = "service_time";

    protected $fillable = ['start','end','mon','tue','wed','thur','fri','sat','sun'];


}

