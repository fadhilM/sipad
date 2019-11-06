@extends('layouts.layout')

@section('content_header')
<section class="content-header">
    <h1>
        Data User
        <small>Index User</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Index User</li>
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
        @php
        Session::forget('error');
        @endphp
        @endif
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Data User</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if (isset($users))
                <table id="dataTable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Nomor Telepon</th>
                            <th>Alamat</th>
                            <th>Hak Akses</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->no_telp}}</td>
                            <td>{{$user->alamat}}</td>
                            <td>{{$user->hak_akses->hak_akses}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('user.show',$user->id_user)}}" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-eye-open"></i></a>
                                    <a href="{{route('user.edit',$user->id_user)}}" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-edit"></i></a>
                                    <a href="{{route('user.delete',$user->id_user)}}" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Nomor Telepon</th>
                            <th>Alamat</th>
                            <th>Hak Akses</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
                @else
                <div class="callout callout-danger">
                    <h4>Gagal Menampilkan Data</h4>
                    
                    <p>Data Yang Anda Cari Tidak Ada Atau Tidak Ditemukan</p>
                </div>
                @endif
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection