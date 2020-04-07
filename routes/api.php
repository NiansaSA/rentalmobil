<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'PetugasController@register');
Route::post('login', 'PetugasController@login');
Route::get('/', function(){
    return Auth::user()->level;
})->middleware('jwt.verify');

Route::get('user', 'PetugasController@getAuthenticatedUser')->middleware('jwt.verify');

#petugas
Route::put('/ubah_petugas/{id}', 'PetugasController@update')->middleware('jwt.verify');
Route::get('/tampil_petugas', 'PetugasController@tampil')->middleware('jwt.verify');
Route::get('/index_petugas/{id}', 'PetugasController@index')->middleware('jwt.verify');
Route::delete('/hapus_petugas/{id}', 'PetugasController@destroy')->middleware('jwt.verify');

#penyewa
Route::post('/simpan_penyewa', 'PenyewaController@store')->middleware('jwt.verify');
Route::put('/ubah_penyewa/{id}', 'PenyewaController@update')->middleware('jwt.verify');
Route::get('/tampil_penyewa', 'PenyewaController@tampil')->middleware('jwt.verify');
Route::get('/index_penyewa/{id}', 'PenyewaController@index')->middleware('jwt.verify');
Route::delete('/hapus_penyewa/{id}', 'PenyewaController@destroy')->middleware('jwt.verify');

#mobil
Route::post('/simpan_mobil', 'MobilController@store')->middleware('jwt.verify');
Route::put('/ubah_mobil/{id}', 'MobilController@update')->middleware('jwt.verify');
Route::get('/tampil_mobil', 'MobilController@tampil')->middleware('jwt.verify');
Route::get('/index_mobil/{id}', 'MobilController@index')->middleware('jwt.verify');
Route::delete('/hapus_mobil/{id}', 'MobilController@destroy')->middleware('jwt.verify');

#jenimobil
Route::post('/simpan_jenis', 'JenisController@store')->middleware('jwt.verify');
Route::put('/ubah_jenis/{id}', 'JenisController@update')->middleware('jwt.verify');
Route::get('/tampil_jenis', 'JenisController@tampil')->middleware('jwt.verify');
Route::get('/index_jenis/{id}', 'JenisController@index')->middleware('jwt.verify');
Route::delete('/hapus_jenis/{id}', 'JenisController@destroy')->middleware('jwt.verify');

#transaksi
Route::post('/simpan_transaksi', 'TransaksiController@store')->middleware('jwt.verify');
Route::put('/ubah_transaksi/{id}', 'TransaksiController@update')->middleware('jwt.verify');
//Route::get('/tampil_transaksi', 'TransaksiController@tampil')->middleware('jwt.verify');
Route::get('/index_transaksi/{tgl_transaksi}/{tgl_selesai}', 'TransaksiController@show')->middleware('jwt.verify');
Route::delete('/hapus_transaksi/{id}', 'TransaksiController@destroy')->middleware('jwt.verify');

#detail_transaksi
Route::post('/simpan_detail', 'DetailController@store')->middleware('jwt.verify');
Route::put('/ubah_detail/{id}', 'DetailController@update')->middleware('jwt.verify');
// Route::get('/tampil_detail', 'DetailController@index')->middleware('jwt.verify');
// Route::get('/index_detail/{tgl_transaksi}/{tgl_selesai}', 'DetailController@index')->middleware('jwt.verify');
Route::delete('/hapus_detail/{id}', 'DetailController@destroy')->middleware('jwt.verify');
