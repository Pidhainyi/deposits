<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $guarded = [];
    const UPDATED_AT = null;

    public function  getCreatedAttribute(){
        return Carbon::parse($this->attributes['created_at'])->format('d/m/Y');
    }

    public function deposit()
    {
        return $this->belongsTo(Deposit::class);
    }

}
