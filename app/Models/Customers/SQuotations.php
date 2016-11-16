<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model as Eloquent;

class SQuotations extends Eloquent
{
    protected $table = "s_quotations";


    public function services(){
        return $this->hasMany(SQuotationServices::class,'quote_id','id');
    }

    //protected $fillable = ['start','end','mon','tue','wed','thur','fri','sat','sun'];


}

