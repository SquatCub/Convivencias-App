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
//  -   -   -   -   -   Vista principal
Route::get('/','General\LandingController@index')->name("index");

//  -   -   -   -   -   Vistas login y registro
Route::get('/login/{opcion?}', function($opcion = "") {
    return view('login.index', compact('opcion'));
});
//  -   -   -   -   -   Controlador para iniciar sesion / cerrar
Route::post('/login_usuario', 'Auth\LoginController@login')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


//Middleware
Route::group(['middleware' => ['auth']], function () {
    /* Rutas para alumnos */
    Route::group(['middleware' => ['usuario']], function () {
        Route::get('/index', 'Sesion\UsuarioController@inicio')->name('inicio.usuario');
    });
    Route::group(['middleware' => ['admin']], function () {
            Route::get('/admin', 'Sesion\AdminController@inicio')->name('inicio.admin');
    });
    Route::group(['middleware' => ['root']], function () {
        Route::get('/root', 'Sesion\RootController@inicio')->name('inicio.root');

        Route::get('/root/administradores', 'Sesion\RootController@administradores')->name('root.admins');

        Route::get('/root/secciones', 'Sesion\RootController@secciones')->name('root.seccions');
        Route::get('/root/secciones/nuevo', 'Sesion\RootController@newSeccion')->name('seccion.new');
        Route::post('/root/secciones/crear', 'Sesion\RootController@createSeccion')->name('seccion.create');
});
});
//Route::get('/', 'General\SolicitudController@index')->name('index');
//Route::post('enviar-solicitud', 'General\SolicitudController@enviarSolicitud')->name('enviar');
