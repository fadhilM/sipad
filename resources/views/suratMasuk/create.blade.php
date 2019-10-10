@extends('layouts.layout')

@section('content_header')

<section class="content-header">
    <h1>
        Data Surat Masuk
        <small>Register Surat Masuk</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Register Surat Masuk</li>
    </ol>
</section>  
@endsection
@section('content')
<div class="row">
    <div class="col-xs-12">
    @if ($categories)
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
        <h3 class="box-title">Register Surat Masuk</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="{{route('suratMasuk.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="box-body">
            <div class="form-group @error('no_surat') has-error @enderror">
                <label for="no_surat" @error('no_surat') class="control-label" @enderror>Nomor Surat</label>
                <input name="no_surat" type="text" class="form-control" id="no_surat" placeholder="Masukkan Nomor Surat">
                @error('no_surat')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group @error('tujuan') has-error @enderror">
                <label for="tujuan" @error('tujuan') class="control-label" @enderror>Tujuan</label>
                <input name="tujuan" type="text" class="form-control" id="tujuan" placeholder="Masukkan Tujuan Surat">
                @error('tujuan')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group @error('dari') has-error @enderror">
                <label for="dari" @error('dari') class="control-label" @enderror>Pengirim</label>
                <input name="dari" type="text" class="form-control" id="dari" placeholder="Masukkan Pengirim Surat">
                @error('dari')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group @error('untuk') has-error @enderror">
                <label for="untuk" @error('untuk') class="control-label" @enderror>Penerima</label>
                <input name="untuk" type="text" class="form-control" id="untuk" placeholder="Masukkan Penerima Surat">
                <input name="id_user" type="hidden" value="{{Auth::user()->id_user}}">
                @error('untuk')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group @error('id_category') has-error @enderror">
                <label @error('id_category') class="control-label" @enderror>Kategori</label>
                <select name="id_category" class="form-control select2" style="width: 100%;" id='id_category'>
                    @foreach ($categories as $category)
                        <option value="{{$category->id_category}}">{{$category->nama_kategori}}</option>
                    @endforeach
                </select>
                @error('hak_akses')
                <span class="id_category">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group @error('keterangan') has-error @enderror">
                <label for="keterangan" @error('keterangan') class="control-label" @enderror>keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Masukkan Keterangan"></textarea>
                @error('keterangan')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group @error('file_surat_masuk') has-error @enderror">
                <label for="file_surat_masuk" @error('file_surat_masuk') class="control-label" @enderror>Masukkan File Surat Masuk</label>
                <input type="file" id="file_surat_masuk" name="file_surat_masuk">
                <p class="help-block">Masukkan File pdf,jpg,png,jpeg. Ukuran Maximal 20mb</p>
                @error('file_surat_masuk')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>
        </div>
        <!-- /.box-body -->
        
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    @else
    <div class="callout callout-danger">
        <h4>Kategori Tidak Ditemukan</h4>

        <p>Silahkan Buat Data Kategori Dahulu Sebelum Registrasi Surat Baru.</p>
    </div>
    @endif
</div>
<!-- /.box -->

@endsection