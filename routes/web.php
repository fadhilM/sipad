<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('coba', function () {
    return view('homepage');
});

Auth::routes();

// Route::middleware(['auth'])->group(function () {

    // Route::middleware(['CheckRole:2'])->group(function() {
        Route::get('/user','UserController@index')->name('user.index');
        Route::get('/user/edit/{id_user}','UserController@edit')->name('user.edit');
        Route::get('/user/show/{id_user}','UserController@show')->name('user.show');
        Route::get('/user/delete/{id_user}', 'UserController@destroy')->name('user.delete');
        Route::match(['put', 'patch'],'user/update/{id_user}','UserController@update')->name('user.update');
    // });

    Route::put('user/show/{id_user}/password','UserController@ubahPassword')->name('user.ubahPassword');
    
    Route::resource('category','CategoryController');
    Route::get('/category/delete/{id_category}', 'CategoryController@destroy')->name('kategori.delete');

    Route::resource('suratMasuk','SuratMasukController');
    Route::get('/suratMasuk/delete/{id_masuk}', 'SuratMasukController@destroy')->name('suratMasuk.delete');
    Route::get('suratMasuk/Download/{id_masuk}','SuratMasukController@download')->name('suratMasuk.download');

    Route::resource('suratKeluar','SuratKeluarController');
    Route::get('/suratKeluar/delete/{id_masuk}', 'SuratKeluarController@destroy')->name('suratKeluar.delete');
    Route::get('suratKeluar/Download/{id_masuk}','SuratKeluarController@download')->name('suratKeluar.download');
    
    
    Route::get('/home', 'HomeController@index')->name('home');
    
// });