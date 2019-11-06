<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\surat;
use App\category;
use App\User;
use Auth;
use Exception;
use Storage;

class SuratMasukController extends Controller
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
                ['tipe', '=', 0]
            ];
            if ($user->hak_akses->hak_akses != 'Operator') {
                $surat_masuk = surat::with('user')
                    ->where($where)
                    ->get();
            } else {
                $surat_masuk = surat::where($where)->get();
            }
            return view('suratMasuk.index',['surat_masuk'=>$surat_masuk]);
        }catch(Exception $e){
            return view('suratMasuk.index')->with('error',$e->getMessage());
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
            return view('suratMasuk.create',['categories'=>$categories]);
        }catch(Exception $e){
            return view('suratMasuk.create')->with('error',$e->getMessage());
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
            'file_surat_masuk' =>['required','file','mimes:jpeg,jpg,png,pdf','max:20048']
        ]);
        try{
            $file = $request->file('file_surat_masuk');
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
                'tipe' => 0,
            ]);

            return redirect()->route('suratMasuk.create')->with('message','Data Berhasil Dibuat');
        }catch(Exception $e){
            return redirect()->route('suratMasuk.create')->with('error',$e->getMessage());
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
            $surat_masuk=surat::with('user','category')->where('id_surat',$id)->first();
            return view('suratMasuk.show',['surat_masuk'=>$surat_masuk]);
        }catch(Exception $e){
            return view('suratMasuk.show')->with('error',$e->getMessage());
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
            $surat_masuk=surat::with('user','category')->where('id_surat',$id)->first();
            $categories=category::all();
            return view('suratMasuk.edit',['surat_masuk'=>$surat_masuk,'categories'=>$categories]);
        }catch(Exception $e){
            return view('suratMasuk.edit')->with('error',$e->getMessage());
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
            'file_surat_masuk' =>['file','mimes:jpeg,jpg,png,pdf','max:20048']
        ]);
        try{
            if ($request->file_surat_masuk != null) {
                Storage::delete($request->dir);
                $file = $request->file('file_surat_masuk');
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
            $surat_masuk=surat::where('id_surat',$id)
                            ->update(['delete'=>1]);;
            return redirect()->route('suratMasuk.index')->with('message','data Berhasil Dihapus');

        }catch(Exception $e){
            return redirect()->route('suratMasuk.index')->with('error',$e->getMessage());

        }
    }
}
