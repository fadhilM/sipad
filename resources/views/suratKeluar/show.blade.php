@extends('layouts.layout')

@section('content_header')
<section class="content-header">
    <h1>
        Data Surat Keluar
        <small>Edit Surat Keluar</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="{{route('suratKeluar.index')}}">Lihat Surat Keluar</a></li>
        <li class="active">Lihat Data Surat Keluar</li>
    </ol>
</section>  
@endsection
@section('content')
<div class="box box-primary">
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i>Error</h4>
            {{session('error')}}
        </div>
        @php
        Session::forget('error');
        @endphp
        @endif
    <div class="box-header with-border">
        <h3 class="box-title">Lihat Data Surat Keluar</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="form-group">
            <label for="nomorSurat">Nomor Surat</label>
            <label class="form-control">{{$surat_keluar->no_surat}}</label>
        </div>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label for="dari">Pengirim</label>
            <label class="form-control">{{$surat_keluar->dari}}</label>
        </div>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label for="untuk">Penerima</label>
            <label class="form-control">{{$surat_keluar->dari}}</label>
        </div>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <label class="form-control">{{$surat_keluar->keterangan}}</label>
        </div>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label for="created_at">Tanggal Registrasi</label>
            <label class="form-control">{{$surat_keluar->created_at->format('d, M Y')}}</label>
        </div>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label for="kategori">Kategori</label>
            <label class="form-control">{{$surat_keluar->category->nama_kategori}}</label>
        </div>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label for="operator">Operator</label>
            <label class="form-control">{{$surat_keluar->user->name}}</label>
        </div>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label for="operator">File : {{$surat_keluar->filename}}</label>
            <a href="{{route('suratMasuk.download',$surat_keluar->id_surat)}}" class="btn btn-lg btn-block btn-primary">Download Disini</a>
        </div>
    </div>

    <!-- /.box-body -->
</div>
<!-- /.box -->

@endsection