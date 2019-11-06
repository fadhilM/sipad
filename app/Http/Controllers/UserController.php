<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\hak_akses;
use DataTables;
use Exception;

class UserController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $user = User::with('hak_akses')->get();
        return view('user.index',['users' => $user]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        //
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
            $user=User::where('id_user',$id)->with('hak_akses')->get();
            return view('user.show',['user'=> $user]);
        }catch(Exception $e){
            return view('user.show',['user'=>$user])->with('error',$e->getMessage());
        }
    }

    public function ubahPassword(Request $request, $id){
        $this->validate($request,[
            'password' => ['string', 'min:8'],
            'password_ulang' => ['string', 'min:8'],
        ]);
        try{
            if($request->input('password') == $request->input('password_ulang')){
                $password = Hash::make($request->input('password'));
                User::where('id_user', $id)->update(['password'=> $password]);
                return redirect()->route('user.show',$id)->with('message', 'Password Berhasil Dirubah');
            }else{
                return redirect()->route('user.show', $id)->with('error', 'Password yang diketikkan tidak sama');
            }

        }catch(Exception $e){
            return redirect()->route('user.show', $id)->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        try{
            $user=User::where('id_user',$id)->get();
            $hak_akses = hak_akses::get();
            return view('user.edit',['user'=>$user, 'hak_akses'=> $hak_akses]);
        }catch(Exception $e){
            return view('user.edit')->with('error',$e->getMessage());
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
        if($request->input('ganti_pass')==1){
            $this->validate($request, [
                'name' => ['required', 'string', 'max:30'],
                'alamat' => ['required', 'string', 'max:40'],
                'no_telp' => ['required', 'numeric', 'digits_between:10,13'],
                'hak_akses' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['string', 'min:8','confirmed'],
                'password_confirmation' => ['string', 'min:8'],
            ]);
        }else{
            $this->validate($request, [
                'name' => ['required', 'string', 'max:30'],
                'alamat' => ['required', 'string', 'max:40'],
                'no_telp' => ['required', 'numeric', 'digits_between:10,13'],
                'hak_akses' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255'],
            ]);
        }

        //update
        try {
            if($request->input('ganti_pass') == 1){
                $password = Hash::make($request->input('password'));
                user::where('id_user', $id)
                    ->update([
                        'name' => $request->input('name'),
                        'alamat' => $request->input('alamat'),
                        'no_telp' => $request->input('no_telp'),
                        'id_hak_akses' => $request->input('hak_akses'),
                        'email' => $request->input('email'),
                        'password' => $password
                    ]);
            }else{
                user::where('id_user', $id)
                    ->update([
                        'name' => $request->input('name'),
                        'alamat' => $request->input('alamat'),
                        'no_telp' => $request->input('no_telp'),
                        'id_hak_akses' => $request->input('hak_akses'),
                        'email' => $request->input('email')
                    ]);
            }


            return redirect('/user')->with('message', 'Data Berhasil Diubah');
        } catch (Exception $e) {
            return redirect('/user')->with('error', $e->getMessage());
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
                $user=user::where('id_user',$id)->delete();
                return redirect('user.index')->with('message','Data Berhasil Dihapus');
            }catch(Exception $e){
                return redirect()->route('user.index')->with('error',$e->getMessage());
            }

        }

        public function AuthRouteAPI(Request $request){
            return $request->user();
        }
    }
