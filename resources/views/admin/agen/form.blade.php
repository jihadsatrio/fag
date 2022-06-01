    {!! Form::hidden('idcourse', isset($agen->id) ? $agen->id : '', ['class' => 'form-control', 'id' => 'idcourse']) !!}
<div class="form-group">
    <label>
        KodeAGEN
    </label>
    {!! Form::text('code_agen', null, ['class' => 'form-control', 'required', 'maxlength' => '100', 'placeholder' => 'Masukkan Kode Agen', 'id' => 'code_agen']) !!}
</div>
<div class="form-group">
    <label>
        Nama AGEN
    </label>
    {!! Form::text('nameagen', isset($agen->name) ? $agen->name : '', ['class' => 'form-control', 'required', 'maxlength' => '100', 'placeholder' => 'Masukkan Nama Agen', 'id' => 'nameagen']) !!}
</div>
{{-- <div class="form-group">
    <label>
        Sks
    </label>
    {!! Form::select('sks', [
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
    ], null, ['class' => 'form-control select2 to-select', 'id' => 'sks', 'required','placeholder' => 'Pilih Sks']) !!}
    <label id="sks-error" class="error" for="sks" style="display: none;">This field is required.</label>
</div> --}}
<div class="form-group">
    <label>
        MUATAN
    </label>
    {!! Form::select('semester', [
        'OIL' => 'OIL',
        'SEMEN' => 'SEMEN',
        'BARANG' => 'BARANG',
        'PASIR' => 'PASIR',
    ], null, ['class' => 'form-control select2 to-select', 'id' => 'semester', 'required','placeholder' => 'Pilih Muatan']) !!}
    <label id="semester-error" class="error" for="semester" style="display: none;">This field is required.</label>
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
