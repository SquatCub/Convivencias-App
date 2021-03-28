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
Route::get('/login','LoginController@index');
Route::get('/', function() {
    return redirect('/login');
});
Route::get('/login/{opcion?}', function($opcion = "") {
    return view('login.index', compact('opcion'));
})->name('index');
//  -   -   -   -   -   
Route::post('/login_usuario', 'Auth\LoginController@login')->name('login');
Route::post('/login_registro', 'Auth\LoginController@loginRegistro')->name('login_registro');

//Route::get('/', 'General\SolicitudController@index')->name('index');
//Route::post('enviar-solicitud', 'General\SolicitudController@enviarSolicitud')->name('enviar');
