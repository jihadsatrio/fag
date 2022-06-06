{!! Form::hidden('idnahkoda', isset($nahkoda->id) ? $nahkoda->id : '', ['class' => 'form-control', 'id' => 'idnahkoda']) !!}
<div class="form-group">
    <label>
        Kode nahkoda
    </label>
    {!! Form::text('code_nahkoda', null, ['class' => 'form-control', 'required', 'maxlength' => '100', 'placeholder' => 'Masukkan Kode nahkoda']) !!}
</div>
<div class="form-group">
    <label>
        Nidn
    </label>
    {!! Form::text('nidnNahkoda', isset($nahkoda->nidn) ? $nahkoda->nidn : '',  ['class' => 'form-control', 'required', 'maxlength' => '100', 'placeholder' => 'Masukkan NIDN ', 'id' => 'nidnNahkoda']) !!}
</div>
<div class="form-group">
    <label>
        Nama
    </label>
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => '100', 'placeholder' => 'Masukkan Nama ']) !!}
</div>
<div class="form-group">
    <label>
        Email
    </label>
    {!! Form::text('emailNahkoda', isset($nahkoda->email) ? $nahkoda->email : '' , ['class' => 'form-control EmailFormat', 'required', 'maxlength' => '100', 'placeholder' => 'Masukkan Email', 'id' => 'emailNahkoda']) !!}
</div>
<button class="btn btn-primary">
    Simpan
</button>
