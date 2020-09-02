<?php

namespace App\Http\Controllers;

use App\Deposit;
use App\Wallet;
use DB;
use Illuminate\Http\Request;



class DepositController extends Controller
{
    const PERSENT = 20;
    const ACTIVE = 1;

    public function createDeposit(Request $request)
    {
        try {
            $userId = \Auth::id();
            $wallet = Wallet::where('user_id', '=', $userId)->with('deposits')->first();
            $wallet->balance -= $request->input('invested');
            $request->request->add([
                'wallet_id' => $wallet->id,
                'user_id' => $userId,
                'percent' => self::PERSENT,
                'active' => self::ACTIVE,
            ]);
            DB::transaction(function () use ($request, $wallet) {
                $wallet->save();
                Deposit::create($request->except('_token'));
            });
        } catch (\Throwable $e) {
            return 'Transaction fail';
        }
        return redirect()->back();
    }


}
