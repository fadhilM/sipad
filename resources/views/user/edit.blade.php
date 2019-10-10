@extends('layouts.layout')

@section('content_header')

<section class="content-header">
    <h1>
        Data User
        <small>Edit User</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="{{route('user.index')}}">Lihat User</a></li>
        <li class="active">Edit User</li>
    </ol>
</section>  
@endsection
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Data User</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="{{route('user.update',$user[0]->id_user)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="box-body">
            <div class="form-group @error('name') has-error @enderror">
                <label for="nama" @error('name') class="control-label" @enderror> Nama</label>
                <input name="name" type="text" class="form-control" id="name" placeholder="Masukkan Nama" value="{{$user[0]->name}}">
                @error('name')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group @error('email') has-error @enderror">
                <label for="email" @error('email') class="control-label" @enderror>Email address</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="Masukkan Alamat Email" value="{{$user[0]->email}}">
                @error('email')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group @error('alamat') has-error @enderror">
                <label for="alamat" @error('alamat') class="control-label" @enderror>Alamat</label>
                <input name="alamat" type="text" class="form-control" id="alamat" placeholder="Masukkan Alamat" value="{{$user[0]->alamat}}">
                @error('alamat')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group @error('no_telp') has-error @enderror">
                <label for="alamat" @error('no_telp') class="control-label" @enderror>Nomor Telepon</label>
                <input name="no_telp" type="text" class="form-control" id="no_telp" placeholder="Masukkan Nomor Telepon" value="{{$user[0]->no_telp}}">
                @error('no_telp')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group @error('hak_akses') has-error @enderror">
                <label @error('hak_akses') class="control-label" @enderror>Hak Akses</label>
                <select name="hak_akses" class="form-control select2" style="width: 100%;" id='hak_akses'>
                    @if ($user[0]->hak_akses==0)
                        <option value="0" selected>Petugas Administrasi</option>
                        <option value="1"> Manager </option>
                        <option value="2"> Admin</option>
                    @elseif($user[0]->hak_akses==1)
                        <option value="0">Petugas Administrasi</option>
                        <option value="1" selected> Manager </option>
                        <option value="2"> Admin</option>
                    @else
                        <option value="0">Petugas Administrasi</option>
                        <option value="1"> Manager </option>
                        <option value="2" selected> Admin</option>
                    @endif
                </select>
                @error('hak_akses')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>
            <input type="hidden" id="id_user" value="{{$user[0]->id_user}}">
        </div>
        <!-- /.box-body -->
        
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
<!-- /.box -->

@endsection