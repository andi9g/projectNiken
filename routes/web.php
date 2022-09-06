<?php

use Illuminate\Support\Facades\Route;

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
Route::post('/proses', "loginC@proses")->name('proses.login');
Route::get('/', "welcomeC@login");
Route::get('scan/{value}', "welcomeC@scan");
Route::get('logout', "welcomeC@logout");

Route::middleware(['GerbangLogin'])->group(function () {
    Route::get('welcome', "welcomeC@index");
    Route::get('admin', "welcomeC@admin");
    Route::get('perangkat', "welcomeC@perangkat");
    
    
    //kelola admin
    Route::post('admin', 'adminC@store')->name('tambah.admin');
    Route::put('admin/{id}/ubah', 'adminC@update')->name('ubah.admin');
    Route::delete('admin/{id}/delete', 'adminC@destroy')->name('hapus.admin');
    Route::post('admin/{id}/akses', 'adminC@akses')->name('akses.admin');
    Route::post('admin/{id}/reset', 'adminC@reset')->name('reset.admin');
    
    
    //kelola perangkat
    Route::post('perangkat', 'perangkatC@store')->name('tambah.perangkat');
    Route::delete('perangkat/{id}', 'perangkatC@destroy')->name('hapus.perangkat');
});
