@extends('layouts.layout')

@section('content_header')

<section class="content-header">
    <h1>
        Data User
        <small>Register User</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Register User</li>
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
        <h3 class="box-title">Register User Baru</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="{{route('register')}}" method="POST">
        @csrf
        <div class="box-body">
            <div class="form-group @error('name') has-error @enderror">
                <label for="nama" @error('name') class="control-label" @enderror> Nama</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Masukkan Nama">
                @error('name')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group @error('email') has-error @enderror">
                <label for="email" @error('email') class="control-label" @enderror>Email address</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="Masukkan Alamat Email">
                @error('email')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group @error('alamat') has-error @enderror">
                <label for="alamat" @error('alamat') class="control-label" @enderror>Alamat</label>
                <input name="alamat" type="text" class="form-control" id="alamat" placeholder="Masukkan Alamat">
                @error('alamat')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group @error('no_telp') has-error @enderror">
                <label for="alamat" @error('no_telp') class="control-label" @enderror>Nomor Telepon</label>
                <input name="no_telp" type="text" class="form-control" id="no_telp" placeholder="Masukkan Nomor Telepon">
                @error('no_telp')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group @error('hak_akses') has-error @enderror">
                <label @error('hak_akses') class="control-label" @enderror>Hak Akses</label>
                <select name="hak_akses" class="form-control select2" style="width: 100%;" id='hak_akses'>
                        <option value="0" selected>Petugas Administrasi</option>
                        <option value="1"> Manager </option>
                        <option value="2"> Admin</option>
                </select>
                @error('hak_akses')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group @error('password') has-error @enderror">
                <label for="password" @error('alamat') class="control-label" @enderror>Password</label>
                <input name="password" type="password" class="form-control" id="password" placeholder="Masukkan Password">
                @error('password')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group ">
                <label for="password">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Masukkan Password Lagi">
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