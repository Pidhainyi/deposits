<form action="{{route('createDeposit')}}" method="POST">
    @csrf
    <div class="input-group">
        <div class="form-group  col-lg-3">
            <label for="addBalance">Invested</label>
            <input type="text" class="form-control" id="invested" name="invested"
                   placeholder="Enter amount">
        </div>
        <div class="form-group col-lg-3">
            <label for="addBalance">Duration</label>
            <input type="text" class="form-control" id="duration" name="duration"
                   placeholder="Enter amount">
        </div>
        <div class="form-group  col-lg-3">
            <label for="addBalance">Accrue Times</label>
            <input type="text" class="form-control" id="accrue_times" name="accrue_times"
                   placeholder="Enter amount">
        </div>
        <div class="form-group col-lg-3" style="padding-top:30px">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
