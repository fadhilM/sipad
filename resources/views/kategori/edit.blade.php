@extends('layouts.layout')

@section('content_header')

<section class="content-header">
    <h1>
        Data Kategori
        <small>Edit Kategori</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="{{route('category.index')}}">Lihat Kategori</a></li>
        <li class="active">Edit Kategori</li>
    </ol>
</section>  
@endsection
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Kategori</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="{{route('category.update',$category[0]->id_category)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="box-body">
            <div class="form-group @error('nama_kategori') has-error @enderror">
                <label for="nama" @error('nama_kategori') class="control-label" @enderror> Nama Kategori</label>
                <input name="nama_kategori" type="text" class="form-control" id="nama_kategori" placeholder="Masukkan Nama Kategori" value="{{$category[0]->nama_kategori}}">
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