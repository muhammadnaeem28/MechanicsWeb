<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model as Eloquent;

class SQuotationServices extends Eloquent
{
    protected $table = "s_quotation_services";

    //protected $fillable = ['start','end','mon','tue','wed','thur','fri','sat','sun'];


/*    public function quotation(){
        return $this->belongsTo(SQuotations::class,'quote_id','id');
    }*/

    public function quotation(){
        return $this->belongsTo(SQuotations::class,'quote_id');
    }
}

