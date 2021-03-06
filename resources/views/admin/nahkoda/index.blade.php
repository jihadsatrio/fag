@extends('admin.layouts.master')

@section('title')
{{ $title= 'nahkoda' }}
@stop

@section('style')
<style type="text/css">
    .panel-body{
       width:auto;
       height:auto;
       overflow-x:auto;
    }
</style>
@stop

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            {{ $title }}
                        </h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse" type="button">
                                <i class="fa fa-minus">
                                </i>
                            </button>
                            <button class="btn btn-box-tool" data-widget="remove" type="button">
                                <i class="fa fa-times">
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            {!! Form::open(['role' => 'form', 'route' => 'admin.nahkoda', 'method' =>'get']) !!}
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::text('searchnidn', Input::get('searchnidn')?: null, ['class' => 'form-control', 'placeholder' => 'Mencari Berdasarkan NIDN']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::text('searchname', Input::get('searchname')?: null, ['class' => 'form-control', 'placeholder' => 'Mencari Berdasarkan Nama']) !!}
                                </div>
                            </div>
                            <div class="col-md-12" style="padding-bottom: 15px;">
                                {!! Form::submit('Search',['class'=>'btn btn-default btn-block']) !!}
                            </div>
                            <div class="col-md-12">
                            {!! Form::close() !!}
                            @include('admin._partials.notifications')
                            <div class="panel-body table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="info">
                                            <th style="text-align:center;">
                                                No.
                                            </th>
                                            <th style="text-align:center;">
                                                Kode nahkoda
                                            </th>
                                            <th style="text-align:center;">
                                                NIDN
                                            </th>
                                            <th style="text-align:center;">
                                                Nama nahkoda
                                            </th>
                                            <th style="text-align:center;">
                                                Email
                                            </th>
                                           <th colspan="2" style="text-align:center;">
                                                <a class="btn btn-primary" href="{{ route('admin.nahkoda.create') }}">
                                                    <i class="fa fa-plus">
                                                    </i>
                                                    Tambah Data
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{$nahkodas = $nahkoda}}
                                        @foreach($nahkodas as $key => $nahkoda)
                                        <tr>
                                            <td align="center">
                                                {{ ($nahkodas->currentpage()-1) * $nahkodas->perpage() + $key + 1 }}
                                            </td>
                                             <td>
                                                {{ $nahkoda->code_nahkoda }}
                                            </td>
                                            <td>
                                                {{ $nahkoda->nidn }}
                                            </td>
                                             <td>
                                                {{ $nahkoda->name }}
                                            </td>
                                             <td>
                                                {{ $nahkoda->email }}
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a class="btn btn-warning btn-sm" href="{{ route('admin.nahkoda.edit', $nahkoda->id) }}">
                                                        <span class="glyphicon glyphicon-edit">
                                                        </span>
                                                        Ubah
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    {!! Form::model($nahkoda, ['route' => ['admin.nahkoda.delete', $nahkoda->id], 'onclick' => 'return confirm("Anda Yakin?");']) !!}
                                                    {!! Form::hidden('_method', 'DELETE') !!}
                                                    {!! Form::button('
                                                    <span class="glyphicon glyphicon-trash">
                                                    </span>
                                                    Hapus', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm']) !!}
                                                {!! Form::close() !!}
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {!! $nahkodas->appends(Input::all())->render() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
