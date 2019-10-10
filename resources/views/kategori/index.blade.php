@extends('layouts.layout')

@section('content_header')
<section class="content-header">
    <h1>
        Data User
        <small>Data Kategori</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active">Data Kategori</li>
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
                <h3 class="box-title">Data Kategori</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if (isset($categories))
                <table id="dataTable" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->nama_kategori}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('category.edit',$category->id_category)}}" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-edit"></i></a>
                                    <a href="{{route('kategori.delete',$category->id_category)}}" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
                                </div>  
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
                @else
                <h1 style="text-align: center;">Data Tidak Ditemukan</h1>
                @endif
                
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection