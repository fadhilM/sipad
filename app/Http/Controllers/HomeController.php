<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use App\surat;
use Carbon\Carbon;
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

        $tgl_skrng = carbon::now();
        $temp_bulan = $tgl_skrng->month;
        $bulan = array();
        $bulan_string = array();
        $i = 6;
        do{
            $bulan[] = $temp_bulan - $i;
            $bulan_string[] = $tgl_skrng->subMonths($i)->format('F');
            $tgl_skrng = carbon::now();
            $i--;
        }while($i>=0);
        $total_srt_msk_perbln = array();
        $total_srt_klr_perbln = array();
        foreach($bulan as $bln){
            $total_srt_msk_perbln[] =  surat::where('tipe','0')->whereMonth('created_at', $bln)->count();
            $total_srt_klr_perbln[] =  surat::where('tipe','1')->whereMonth('created_at', $bln)->count();
        }

        $segmentasi_surat_by_kategori = surat::select(\DB::raw("count(id_surat) as 'Total_Surat', id_category"))->with('category')->groupBy('id_category')->get();

        return view('home')->with([
            'total_surat'=>$total_surat,
            't_surat_masuk'=>$t_surat_masuk,
            't_surat_keluar'=>$t_surat_keluar,
            't_kategori'=>$t_kategori,
            'total_srt_msk_perbln' => $total_srt_msk_perbln,
            'total_srt_klr_perbln' => $total_srt_klr_perbln,
            'bulan' => $bulan_string,
            'segmentasi_surat_by_kategori' => $segmentasi_surat_by_kategori
        ]);
    }

}
