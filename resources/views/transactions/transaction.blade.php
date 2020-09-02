<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Тип</th>
        <th scope="col">Сумма</th>
        <th scope="col">Дата</th>
    </tr>
    </thead>
    <tbody>
    @foreach($deposits as $deposit)
        @foreach($deposit->transactions as $transaction)
    <tr>
        <th scope="row">{{$transaction->id}}</th>
        <td>{{$transaction->type}}</td>
        <td>{{$transaction->amount}}</td>
        <td>{{$transaction->created}}</td>
    </tr>
          @endforeach
    @endforeach
    </tbody>
</table>
