<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use Exception;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=category::all()->where('delete',null);
        return view('kategori.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create');
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
            'nama_kategori' => ['required', 'string', 'max:30']
        ]);
        try{
            $category=category::create([
                'nama_kategori' => $request['nama_kategori']
            ]);
            return redirect()->route('category.create')->with('message','Data Berhasil Dibuat');
        }catch(Exception $e){
            return redirect()->route('category.create')->with('error',$e->getMessage());
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
        //
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
            $category=category::where('id_category',$id)->get();
            return view('kategori.edit',['category'=>$category]);
        }catch(Exception $e){
            return view('kategori.edit')->with('error',$e->getMessage());
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
        try{
            $this->validate($request,[
                'nama_kategori' => ['required', 'string', 'max:30']
            ]);
            $category=category::where('id_category',$id)
                                ->update([
                                    'nama_kategori'=>$request->input('nama_kategori')
                                ]);

            return redirect()->route('category.index')->with('message','Data Berhasil Diubah'); 
        }catch(Exception $e){
            return redirect()->route('category.index')->with('error',$e->getMessage());
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
            $category = category::where('id_category',$id)
                            ->update(['delete'=>1]);
            return redirect()->route('category.index')->with('message','Data Berhasil Dihapus');
        }catch(Exception $e){
            return redirect()->route('category.index')->with('error',$e->getMessage());
        }
    }
}
