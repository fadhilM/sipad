@extends('layouts.layout')

@section('content_header')
<section class="content-header">
    <h1>
        Data Keluar
        <small>Index Surat Keluar</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Index Surat Keluar</li>
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
                <h3 class="box-title">Data Surat Keluar</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if (isset($surat_keluar))
                <table id="dataTable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nomor Surat</th>
                            <th>Tujuan</th>
                            <th>Pengirim</th>
                            <th>Penerima</th>
                            <th>Tanggal Registrasi</th>
                            @if (auth::user()->hak_akses->hak_akses!='Operator')
                               <th>Registrator</th> 
                            @endif
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($surat_keluar as $sm)
                        <tr>
                            <td>{{$sm->no_surat}}</td>
                            <td>{{$sm->tujuan}}</td>
                            <td>{{$sm->dari}}</td>
                            <td>{{$sm->untuk}}</td>
                            <td>{{$sm->created_at->format('d, M Y')}}</td>
                            @if (auth::user()->hak_akses->hak_akses!='Operator')
                               <td>{{$sm->user->name}}</td> 
                            @endif
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('suratMasuk.show',$sm->id_surat)}}" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-eye-open"></i></a>
                                    @if(Auth::user()->id_hak_akses!=1)
                                    <a href="{{route('suratMasuk.edit',$sm->id_surat)}}" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-edit"></i></a>
                                    <a href="{{route('suratMasuk.delete',$sm->id_surat)}}" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nomor Surat</th>
                            <th>Tujuan</th>
                            <th>Pengirim</th>
                            <th>Penerima</th>
                            <th>Tanggal Registrasi</th>
                            @if (auth::user()->hak_akses->hak_akses!='Operator')
                               <th>Registrator</th> 
                            @endif
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