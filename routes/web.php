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
        #   -   -   -   -   -   -   Funciones para Administradores
        Route::get('/root/administradores', 'Sesion\RootController@administradores')->name('root.admins');
        Route::get('/root/administradores/nuevo', 'Sesion\RootController@newAdmin')->name('admin.new');
        Route::post('/root/administradores/crear', 'Sesion\RootController@createAdmin')->name('admin.create');
        Route::get('/root/administradores/editar/{id}', 'Sesion\RootController@editAdmin')->name('admin.editar');
        Route::post('/root/administradores/update', 'Sesion\RootController@updateAdmin')->name('admin.update');
        Route::delete('/root/administradores/eliminar/{id}', 'Sesion\RootController@deleteAdmin')->name('admin.eliminar');
        #   -   -   -   -   -   -   Funciones para Secciones
        Route::get('/root/secciones', 'Sesion\RootController@secciones')->name('root.seccions');
        Route::get('/root/secciones/nuevo', 'Sesion\RootController@newSeccion')->name('seccion.new');
        Route::post('/root/secciones/crear', 'Sesion\RootController@createSeccion')->name('seccion.create');
        Route::get('/root/secciones/editar/{id}', 'Sesion\RootController@editSeccion')->name('seccion.editar');
        Route::post('/root/secciones/update','Sesion\RootController@updateSeccion')->name('seccion.update');
        Route::delete('/root/secciones/eliminar/{id}', 'Sesion\RootController@deleteSeccion')->name('seccion.eliminar');
        #   -   -   -   -   -   -   Funciones para Superusuarios
        Route::get('/root/superusuarios', 'Sesion\RootController@superusers')->name('root.superusers');
        Route::get('/root/superusuarios/nuevo', 'Sesion\RootController@newRoot')->name('root.new');
        Route::post('/root/superusuarios/crear', 'Sesion\RootController@createRoot')->name('root.create');
        Route::get('/root/superusuarios/editar/{id}', 'Sesion\RootController@editRoot')->name('root.editar');
        Route::post('/root/superusuarios/update', 'Sesion\RootController@updateRoot')->name('root.update');
        Route::delete('/root/superusuarios/eliminar/{id}', 'Sesion\RootController@deleteRoot')->name('root.eliminar');
});
});
//Route::get('/', 'General\SolicitudController@index')->name('index');
//Route::post('enviar-solicitud', 'General\SolicitudController@enviarSolicitud')->name('enviar');
