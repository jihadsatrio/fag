{!! Form::hidden('idkapal', isset($kapal->id) ? $kapal->id : '', ['class' => 'form-control', 'id' => 'idkapal']) !!}
<div class="form-group">
    <label>
        Kode kapal
    </label>
    {!! Form::text('code_kapal', null, ['class' => 'form-control', 'required', 'maxlength' => '100', 'placeholder' => 'Masukkan Kode Ruang', 'id' => 'code_kapal']) !!}
</div>
<div class="form-group">
    <label>
        Nama kapal
    </label>
    {!! Form::text('namekapal', isset($kapal->name) ? $kapal->name : '', ['class' => 'form-control', 'required', 'maxlength' => '100', 'placeholder' => 'Masukkan Nama kapal', 'id' => 'namekapal']) !!}
</div>
<div class="form-group">
    <label>
        Kapasitas
    </label>
    {!! Form::text('capacity', null, ['class' => 'form-control', 'required', 'maxlength' => '100', 'placeholder' => 'Masukkan kapasitas ']) !!}
</div>
<div class="form-group">
    <label>
        Jenis
    </label>
    {!! Form::select('type', $type, null, ['class' => 'form-control select2 to-select', 'id' => 'type', 'required','placeholder' => 'Pilih Jenis']) !!}
    <label id="type-error" class="error" for="type" style="display: none;">This field is required.</label>
</div>
<button class="btn btn-primary">
    Simpan
</button>
