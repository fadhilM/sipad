@extends('layouts.layout')

@section('style')
   <style>
       .font-profile{
           font-size: 90%;
       }

       .btn-profile{
           padding: 0vh;
           height: 3.5vh;
       }
   </style> 
@endsection

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
        </div>
    <div class="col-md-3">
         <!-- Profile Image -->
            <div class="box box-primary" style="min-height: 54vh">
                <div id="profile" class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{asset('AdminLte/dist/img/user2-160x160.jpg')}}" alt="User profile picture">
                    <h3 class="profile-username text-center">{{$user[0]->name}}</h3>
                    <p class="text-muted text-center">{{$user[0]->hak_akses->hak_akses}}</p>
                    @if($user[0]->id_hak_akses == Auth::user()->id_hak_akses)
                        <form role="form" action="{{route('user.ubahPassword',$user[0]->id_user)}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        @if ($errors->any() or session('error'))
                            @if(session('error'))
                                <div class="has-error">
                            @endif
                            <div class="form-group @error('password') has-error @enderror">
                                <label class="font-profile" for="password" >Password</label>
                                <input name="password" type="password" class="form-control" id="password" placeholder="Masukkan Password Baru">
                                @error('password')
                                <span class="help-block">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group @error('password_ulang') has-error @enderror">
                                <label class="font-profile" for="password" >Ketik Ulang Password</label>
                                <input name="password_ulang" type="password" class="form-control" id="password_ulang" placeholder="Ketik Ulang Password">
                                @error('password_ulang')
                                    <span class="help-block">{{$message}}</span>
                                @enderror
                            </div>
                            @if(session('error'))
                                <span class="help-block">{{session('error')}}</span>
                            @endif
                            <button class="btn btn-primary btn-block btn-profile" style="" id=""><b>Ubah Password</b></button>
                            @if(session('error'))
                                </div>
                            @endif
                            @php
                            Session::forget('error');
                            @endphp
                        @else
                            <button class="btn btn-primary btn-block" style="" id="ubah_password"><b>Ubah Password</b></button>
                        @endif
                    </form>
                    @endif
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
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
</div>
@endsection
@section('script')
<script>
    $(function(){
        $("button#ubah_password").click(function(event){
            $("#profile").find('#ubah_password').replaceWith(`
                <div class="form-group">
                    <label class="font-profile" for="password" >Password</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Masukkan Password Baru">
                </div>
                <div class="form-group">
                    <label class="font-profile" for="password" >Ketik Ulang Password</label>
                    <input name="password_ulang" type="password" class="form-control" id="password_ulang" placeholder="Ketik Ulang Password">
                </div>
                <button class="btn btn-primary btn-block btn-profile" style="" id="ubah_password"><b>Ubah Password</b></button>
            `);
        })
    })
</script>
@endsection