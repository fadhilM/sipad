<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\surat;
use App\category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.                  
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_surat=surat::count();
        $t_surat_masuk = surat::where('tipe', 0)->count();
        $t_surat_keluar = surat::where('tipe', 1)->count();
        $t_kategori = category::count();
        return view('home')->with(['total_surat'=>$total_surat,'t_surat_masuk'=>$t_surat_masuk,'t_surat_keluar'=>$t_surat_keluar,'t_kategori'=>$t_kategori]);
    }

}
