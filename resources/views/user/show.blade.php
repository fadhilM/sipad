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
        <li class="active">Lihat Data User</li>
    </ol>
</section>  
@endsection
@section('content')
<div class="row">
    <div class="col-md-3">
         <!-- Profile Image -->
            <div class="box box-primary" style="min-height: 54vh">
                <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="{{asset('AdminLte/dist/img/user2-160x160.jpg')}}" alt="User profile picture">

                <h3 class="profile-username text-center">{{$user[0]->name}}</h3>

                <p class="text-muted text-center">Software Engineer</p>

                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                    <b>Followers</b> <a class="pull-right">1,322</a>
                    </li>
                    <li class="list-group-item">
                    <b>Following</b> <a class="pull-right">543</a>
                    </li>
                    <li class="list-group-item">
                    <b>Friends</b> <a class="pull-right">13,287</a>
                    </li>
                </ul>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Lihat Data User</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <label class="form-control">{{$user[0]->name}}</label>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <label class="form-control">{{$user[0]->email}}</label>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <label class="form-control">{{$user[0]->alamat}}</label>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Nomor Telepon</label>
                        <label class="form-control">{{$user[0]->no_telp}}</label>
                    </div>
                    <div class="form-group">
                        <label for="Hak Akses">Jabatan</label>
                        @if ($user[0]->hak_akses==0)
                            <label class="form-control">Petugas Administrasi</label>
                        @elseif($user[0]->hak_akses==1)
                            <label class="form-control">Manager</label>
                        @else
                            <label class="form-control">Admin</label>
                        @endif
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
</div>


@endsection