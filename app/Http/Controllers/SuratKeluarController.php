<?php

namespace App\Http\Controllers;
use App\surat;
use App\category;
use App\User;
use Auth;
use Exception;
use Storage;

use Illuminate\Http\Request;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $user = User::where('id_user', Auth::user()->id_user)->with('hak_akses')->first();
            $where = [
                ['delete', '<>', 1],
                ['tipe', '=', 1]
            ];
            if ($user->hak_akses->hak_akses!='Operator') {
                $surat_keluar = surat::with('user')
                    ->where($where)
                    ->get();
                
            } else {
                $surat_keluar = surat::where($where)->get();
            }
            
            
            return view('suratKeluar.index',['surat_keluar'=>$surat_keluar]);
        }catch(Exception $e){
            return view('suratKeluar.index')->with('error',$e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            $categories=category::all()->where('delete',null);
            return view('suratKeluar.create',['categories'=>$categories]);
        }catch(Exception $e){
            return view('suratKeluar.create')->with('error',$e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'no_surat' => ['required', 'string', 'max:100'],
            'dari' => ['required','string','max:40'],
            'untuk' => ['required','string','max:40'],
            'id_category' =>['required'],
            'id_user' =>['required'],
            'tujuan' =>['required','max:100','string'],
            'keterangan' =>['required','string'],
            'file_surat_keluar' =>['required','file','mimes:jpeg,jpg,png,pdf','max:20048']
        ]);
        try{
            $file = $request->file('file_surat_keluar');
            $fileName = $file->getClientOriginalName();
            $coba = $fileName;
            $path = $file->store('public/surat');
            $surat_masuk=surat::create([
                'no_surat' => $request->input('no_surat'),
                'dari' => $request->input('dari'),
                'untuk' => $request->input('untuk'),
                'id_category' => $request->input('id_category'),
                'id_user' => $request->input('id_user'),
                'tujuan' => $request->input('tujuan'),
                'keterangan' => $request->input('keterangan'),
                'dir' => $path,
                'filename' => $coba,
                'tipe' => 1
            ]);
            return redirect()->route('suratKeluar.create')->with('message','Data Berhasil Dibuat');
        }catch(Exception $e){
            return redirect()->route('suratKeluar.create')->with('error',$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $surat_keluar=surat::with('user','category')->where('id_surat',$id)->first();
            return view('suratKeluar.show',['surat_keluar'=>$surat_keluar]);    
        }catch(Exception $e){
            return view('suratKeluar.show')->with('error',$e->getMessage());
        }
    }

    public function download($id){
        try{
            $surat=surat::findOrFail($id)->first();
            return Storage::download($surat->dir,$surat->filename);  
        }catch(Exception $e){
            return view('suratMasuk.show')->with('error',$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $surat_keluar=surat::with('user','category')->where('id_surat',$id)->first();
            $categories=category::all();
            return view('suratKeluar.edit',['surat_keluar'=>$surat_keluar,'categories'=>$categories]);    
        }catch(Exception $e){
            return view('suratKeluar.edit')->with('error',$e->getMessage());
        }
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'no_surat' => ['required', 'string', 'max:100'],
            'dari' => ['required','string','max:40'],
            'untuk' => ['required','string','max:40'],
            'id_category' =>['required'],
            'tujuan' =>['required','max:100','string'],
            'keterangan' =>['required','string'],
            'file_surat_keluar' =>['file','mimes:jpeg,jpg,png,pdf','max:20048']
        ]);
        try{
            if ($request->file_surat_keluar != null) {
                Storage::delete($request->dir);
                $file = $request->file('file_surat_keluar');
                $fileName = $file->getClientOriginalName();
                $coba = $fileName;
                $path = $file->store('public/surat');
                $surat_masuk=surat::where('id_surat',$id)->update([
                    'no_surat' => $request->input('no_surat'),
                    'dari' => $request->input('dari'),
                    'untuk' => $request->input('untuk'),
                    'id_category' => $request->input('id_category'),
                    'tujuan' => $request->input('tujuan'),
                    'keterangan' => $request->input('keterangan'),
                    'dir' => $path,
                    'filename' => $coba
                ]);
            }else{
                $surat_masuk=surat::where('id_surat',$id)->update([
                    'no_surat' => $request->input('no_surat'),
                    'dari' => $request->input('dari'),
                    'untuk' => $request->input('untuk'),
                    'id_category' => $request->input('id_category'),
                    'tujuan' => $request->input('tujuan'),
                    'keterangan' => $request->input('keterangan')
                ]);
            }
            

            return redirect()->route('suratMasuk.index')->with('message','Data Berhasil Diedit');
        }catch(Exception $e){
            return redirect()->route('suratMasuk.index')->with('error',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $dir=surat::find($id)->first();
            Storage::delete($dir->dir); 
            $surat_keluar=surat::where('id_surat',$id)
                            ->update(['delete'=>1]);;    
            return redirect()->route('suratKeluar.index')->with('message','data Berhasil Dihapus');
            
        }catch(Exception $e){
            return redirect()->route('suratKeluar.index')->with('error',$e->getMessage());

        }
    }
}
