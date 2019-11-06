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
        <div class="box-body" id="body">
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
                    @foreach ($hak_akses as $hk)
                        @if ($hk->id_hak_akses == $user[0]->id_hak_akses)
                            <option value="{{$hk->id_hak_akses}}" selected>{{$hk->hak_akses}}</option>
                        @else
                             <option value="{{$hk->id_hak_akses}}">{{$hk->hak_akses}}</option>
                        @endif
                    @endforeach
                </select>
                @error('hak_akses')
                <span class="help-block">{{$message}}</span>
                @enderror
            </div>
            <input type="hidden" name="id_user"  id="id_user" value="{{$user[0]->id_user}}">

            @if($errors->get('password')!=null  or $errors->get('error')!=null)
                <input type="hidden" name="ganti_pass" id="ganti_pass" value="1">
                <div class="form-group @error('password') has-error @enderror" id="pass">
                    <label @error('password') class="control-label" @enderror>Password</label>
                    <input name="password" type="password" class="form-control" id="no_telp" placeholder="Masukkan Password">
                    @error('password')
                        <span class="help-block">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group @error('password_confirmation') has-error @enderror" id="pass_ulang">
                    <label @error('password_confirmation') class="control-label" @enderror>Ketik Ulang Password</label>
                    <input name="password_confirmation" type="password" class="form-control" id="no_telp" placeholder="Ketik Ulang Password Baru">
                    @error('password_confirmation')
                        <span class="help-block">{{$message}}</span>
                    @enderror
                </div>
            @else
                <input type="hidden" name="ganti_pass" id="ganti_pass" value="0">
            @endif


        </div>
        <!-- /.box-body -->

        <div class="box-footer" id="footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            @if($errors->get('password')!=null  or $errors->get('error')!=null)
                <button type="button" class="btn btn-warning"  style="float:right;display:none;" id="ubah_password" >Ubah Password</button>
                <button type="button" class="btn btn-danger"  style="float:right; " id="batal" >Batal Ubah Password</button>
            @else
                <button type="button" class="btn btn-warning"  style="float:right;" id="ubah_password" >Ubah Password</button>
                <button type="button" class="btn btn-danger"  style="float:right; display:none;" id="batal" >Batal Ubah Password</button>
            @endif
        </div>
    </form>
</div>
<!-- /.box -->

@endsection

@section('script')
    <script type="text/javascript">
        $(function(){

            $('#ubah_password').click(function(event){
                $("#ganti_pass").val('1');
                $("#body").append(`
                    <div class="form-group" id="pass">
                        <label>Password</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Masukkan Password">
                    </div>
                    <div class="form-group" id="pass_ulang">
                        <label>Ketik Ulang Password</label>
                        <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="Ketik Ulang Password Baru">
                    </div>
                `);
                $("#batal").show();
                $("#ubah_password").hide();
            });


            $('#batal').click(function(event){
                $("#ganti_pass").val('0');
                $("#pass,#pass_ulang").remove();
                $("#ubah_password").show();
                $("#batal").hide();
            });
        });
    </script>
@endsection
