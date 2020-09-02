<form action="{{route('increaseBalance',request()->route()->parameter('id'))}}" method="POST">
    @csrf
    <div class="input-group">
        <div class="form-group  col-lg-6">
            <label for="addBalance">Invested</label>
            <input type="text" class="form-control" id="invested" name="money"
                   placeholder="Enter amount">
        </div>
        <div class="form-group col-lg-6" style="padding-top:30px">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
