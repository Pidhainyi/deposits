<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $guarded = [];
    const UPDATED_AT = null;

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    static protected function boot()
    {
        parent::boot();
        static::created(function (Wallet $wallet) {
            Transactions::query()->create([
                'user_id' => Auth::id(),
                'wallet_id' => $wallet->id,
                'deposit_id' => '',
                'type' => 'entered',
                'amount' => $wallet->balance
            ]);
        });
    }

}
