<?php

namespace App;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class Deposit extends Model
{
    protected $guarded = [];
    const UPDATED_AT = null;


    public function getActiveAttribute()
    {
        return  $this->attributes['active'] == 1 ? 'Open' : 'Close';
    }
    public function  getCreatedAttribute(){
        return Carbon::parse($this->attributes['created_at'])->format('d/m/Y');
    }

    public function scopeUserDeposits(Builder $query)
    {
        return $query->where('user_id', '=', \Auth::id())->with('transactions');

    }

    public function percentSum()
    {
        return \DB::table('transactions')->selectRaw('sum(amount) as amounts')
            ->where('deposit_id', '=', $this->id)
            ->where('type', '=', 'accrue')
            ->groupBy('deposit_id')->first();
    }

    public function getPercentSumAttribute()
    {
        $percentSum = $this->percentSum();
        return $percentSum ? $percentSum->amounts: 0;
    }

    public function transactions()
    {
        return $this->hasMany(Transactions::class);
    }
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    static protected function boot()
    {
        parent::boot();
        static::created(function (Deposit $deposit) {
            Transactions::query()->create([
                'user_id' => $deposit->user_id,
                'wallet_id' => $deposit->wallet_id,
                'deposit_id' => $deposit->id,
                'type' => 'create_deposit',
                'amount' => $deposit->invested
            ]);
        });

        static::updated(function (Deposit $deposit) {
            $transactionType = 'accrue';
            if ($deposit->accrue_times == 0) {
                $transactionType = 'close_deposit';
            }
            $amount = $deposit->invested - $deposit->getOriginal('invested');
            Transactions::query()->create([
                'user_id' => $deposit->user_id,
                'wallet_id' => $deposit->wallet_id,
                'deposit_id' => $deposit->id,
                'type' => $transactionType,
                'amount' => $amount
            ]);
        });
    }

}
