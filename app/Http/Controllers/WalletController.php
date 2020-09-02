<?php

namespace App\Http\Controllers;

use App\Deposit;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class WalletController extends Controller
{
    private $wallet;

    /**
     * WalletController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {

        $this->wallet = Wallet::find($request->id);
    }

    public function balance()
    {


        return view('balance',
            [
                'balance' => $this->wallet->balance,
                'deposits' => Deposit::userDeposits()->get(),
            ]);
    }

    public function increaseBalance(Request $request)
    {
        $money = $request->get('money');
        $this->wallet->balance += $money;

        try {
            DB::transaction(function () {
                $this->wallet->save();
            });
        } catch (\Throwable $e) {
            return 'Transaction fail';
        }

        return redirect()->route('wallet', $this->wallet->id);
    }

}
