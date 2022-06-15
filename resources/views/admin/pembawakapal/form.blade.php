 {!! Form::hidden('idnahkoda', isset($nahkoda->id) ? $nahkoda->id : '', ['class' => 'form-control', 'id' => 'idnahkoda']) !!}
<div class="form-group">
    <label>
        Dosen
    </label>
    {!! Form::select('nahkoda', $nahkoda, isset($nahkoda->nahkoda_id) ? $nahkoda->nahkoda_id : '' ,['class' => 'form-control select2 to-select','id' => 'nahkoda', 'required', 'placeholder' => 'Pilih Nahkoda']) !!}
    <label id="nahkoda-error" class="error" for="nahkoda" style="display: none;">This field is required.</label>
</div>
<div class="form-group">
    <label>
        Mata Kuliah
    </label>
    {!! Form::select('agen', $agen, isset($nahkoda->agen_id) ? $nahkoda->agen_id : '' ,['class' => 'form-control select2 to-select','id' => 'agen', 'required', 'placeholder' => 'Pilih Agen']) !!}    <label id="agen-error" class="error" for="agen" style="display: none;">This field is required.</label>
</div>
<div class="form-group">
    <label>
        Nahkoda
    </label>
    {!! Form::text('roomclass', isset($nahkoda->class_kapal) ? $nahkoda->class_kapal : '', ['class' => 'form-control', 'required', 'maxlength' => '100', 'placeholder' => 'Masukan Kelas','id' => 'roomclass']) !!}
</div>
<div class="form-group">
     <label>
        Tahun 
    </label>
    {!! Form::text('year', null, ['class' => 'form-control', 'required', 'maxlength' => '100', 'placeholder' => 'Masukan Tahun']) !!}
</div>
<button class="btn btn-primary">
    Simpan
</button>
