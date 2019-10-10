@extends('layouts.layout')

@section('content_header')

<section class="content-header">
    <h1>
        Data Kategori
        <small>Buat Kategori</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Buat Kategori</li>
    </ol>
</section>  
@endsection
@section('content')
<div class="row">
<div class="col-xs-12">
    @if (session('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Sukses</h4>
            {{session('message')}}
        </div>
        @php
            Session::forget('message');
        @endphp
        @endif
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i>Error</h4>
            {{session('error')}}
        </div>
        @endif
        @php
            Session::forget('error');
        @endphp
</div>
</div>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Register Kategori Baru</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="{{route('category.store')}}" method="POST">
        @csrf
        <div class="box-body">
            <div class="form-group @error('nama_kategori') has-error @enderror">
                <label for="nama" @error('nama_kategori') class="control-label" @enderror> Nama Kategori</label>
                <input name="nama_kategori" type="text" class="form-control" id="nama_kategori" placeholder="Masukkan Nama Kategori">
                @error('nama_kategori')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>
        </div>
        <!-- /.box-body -->
        
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
<!-- /.box -->

@endsection