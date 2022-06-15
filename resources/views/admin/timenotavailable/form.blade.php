{!! Form::hidden('idtimenotavailables', isset($timenotavailables->id) ? $timenotavailables->id : '', ['class' => 'form-control', 'id' => 'idtimenotavailables']) !!}
<div class="form-group">
    <label>
        Nahkoda
    </label>
     {!! Form::select('nahkoda', $nahkoda, isset($timenotavailables->nahkoda_id) ? $timenotavailables->nahkoda_id : '' ,['class' => 'form-control select2 to-select','id' => 'nahkoda', 'required', 'placeholder' => 'Pilih Nahkoda']) !!}
    <label id="nahkoda-error" class="error" for="nahkoda" style="display: none;">This field is required.</label>
</div>
<div class="form-group">
    <label>
        Hari
    </label>
     {!! Form::select('days', $days, isset($timenotavailables->days_id) ? $timenotavailables->days_id : '' ,['class' => 'form-control select2 to-select','id' => 'days', 'required', 'placeholder' => 'Pilih Hari']) !!}
    <label id="days-error" class="error" for="days" style="display: none;">This field is required.</label>
</div>
<div class="form-group">
    <label>
        Waktu
    </label>
    {!! Form::select('times', $times, isset($timenotavailables->times_id) ? $timenotavailables->times_id :'' , ['class' => 'form-control select2 to-select', 'id' => 'times', 'required','placeholder' => 'Pilih Waktu']) !!}
    <label id="times-error" class="error" for="times" style="display: none;">This field is required.</label>
</div>
<button class="btn btn-primary">
    Simpan
</button>
