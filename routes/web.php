<?php

use App\Http\Controllers\DepositController;
use App\Http\Controllers\WalletController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {
    Route::get('wallet/balance/{id}', [WalletController::class, 'balance'])->name('wallet');
    Route::post('increase/balance/{id}', [WalletController::class, 'increaseBalance'])->name('increaseBalance');
    Route::post('create/deposit', [DepositController::class, 'createDeposit'])->name('createDeposit');
});
