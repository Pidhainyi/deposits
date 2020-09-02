<!DOCTYPE html>
<html lang="en">
<head>
    <title>Deposits</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<p style="text-align: center">Balance:{{$balance}}</p>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            @include('wallet.replenish')
        </div>
        <div class="col-md-8">
            @include('deposit.create')
        </div>

        <div class="col-md-10 table-responsive">
            @include('deposit.all')
        </div>
        <div class="col-md-4 table-responsive">
            @include('transactions.transaction')
        </div>
    </div>
</div>









