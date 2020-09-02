<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Сумма вклада</th>
        <th scope="col">Процент</th>
        <th scope="col">Количество текущих начислений</th>
        <th scope="col">Сумма начислений</th>
        <th scope="col">Статус депозита</th>
        <th scope="col">Дата</th>
    </tr>
    </thead>
    <tbody>

    @foreach($deposits as $deposit)

        <tr>
            <td>{{$deposit->id}}</td>
            <td>{{$deposit->invested}}</td>
            <td>{{$deposit->percent}}</td>
            <td>{{$deposit->transactions->count()}}</td>
            <td>{{$deposit->percent_sum}}</td>
            <td>{{$deposit->active}}</td>
            <td>{{$deposit->created}}
        </tr>
    @endforeach
    </tbody>
</table>
