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
//  Controladores para actividades
Route::get('/actividades','General\LandingController@actividades')->name("actividades");
Route::get('/actividades/{actividad}', 'General\LandingController@verActividad')->name("verActividad");
Route::get('/categorias','General\LandingController@categorias')->name("categorias");
Route::get('/categorias/{categoria}', 'General\LandingController@verCategoria')->name("verCategoria");

//  -   -   -   -   -   Vistas login y registro
// Registro
Route::post('enviar-solicitud', 'General\SolicitudController@enviarSolicitud')->name('enviar');
// Login
Route::get('/login/{opcion}','General\LandingController@login');

//  -   -   -   -   -   Controlador para iniciar sesion / cerrar
Route::post('/login_usuario', 'Auth\LoginController@login')->name('log');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


//Middleware
Route::group(['middleware' => ['auth']], function () {
    /* Rutas para alumnos */
    #   -   -   -   -   -   -   Funciones para usuarios normales
    Route::group(['middleware' => ['usuario']], function () {
        Route::get('/index', 'General\LandingController@index')->name('inicio.usuario');

        Route::post('/usuario/compartir', 'Sesion\UsuarioController@createComentario')->name('comentario.create');
    });
    #   -   -   -   -   -   -   Funciones para administradores
    Route::group(['middleware' => ['admin']], function () {
            Route::get('/admin', 'Sesion\AdminController@inicio')->name('inicio.admin');
            #   -   -   -   -   -   -   Funciones para Categorias
            Route::get('/admin/categorias', 'Sesion\AdminController@categorias')->name('admin.categorias');
            Route::get('/admin/categorias/nuevo', 'Sesion\AdminController@newCategoria')->name('categoria.new');
            Route::get('/admin/categorias/editar/{id}', 'Sesion\AdminController@editCategoria')->name('categoria.edit');
            Route::post('/admin/categorias/update', 'Sesion\AdminController@updateCategoria')->name('categoria.update');
            Route::post('/admin/categorias/crear', 'Sesion\AdminController@createCategoria')->name('categoria.create');
            Route::delete('/admin/categorias/eliminar/{id}', 'Sesion\AdminController@deleteCategoria')->name('categoria.eliminar');

            Route::get('/categoria/{categoria}/actividades', 'Sesion\AdminController@actividadCategoria')->name("categoria.actividades");
            #   -   -   -   -   -   -   Funciones para Actividades
            Route::get('/admin/actividades', 'Sesion\AdminController@actividades')->name('admin.actividades');
            Route::get('/admin/actividades/nuevo', 'Sesion\AdminController@newActividad')->name('actividad.new');
            Route::post('/admin/actividades/crear', 'Sesion\AdminController@createActividad')->name('actividad.create');
            Route::get('/admin/actividades/editar/{id}', 'Sesion\AdminController@editActividad')->name('actividad.edit');
            Route::post('/admin/actividades/update', 'Sesion\AdminController@updateActividad')->name('actividad.update');
            Route::delete('/admin/actividades/eliminar/{id}', 'Sesion\AdminController@deleteActividad')->name('actividad.eliminar');

            Route::get('/admin/actividades/ver/{id}', 'Sesion\AdminController@verActividad')->name('actividad.ver');
            Route::delete('/admin/actividades/eliminar_comentario/{id}', 'Sesion\AdminController@deleteComentario')->name('comentario.eliminar');
            #   -   -   -   -   -   -   Funciones para Usuarios
            Route::get('/admin/usuarios', 'Sesion\AdminController@usuarios')->name('admin.usuarios');
            Route::get('/admin/usuarios/nuevo', 'Sesion\AdminController@newUsuario')->name('usuario.new');
            Route::post('/admin/usuarios/crear', 'Sesion\AdminController@createUsuario')->name('usuario.create');
            Route::get('/admin/usuarios/editar/{id}', 'Sesion\AdminController@editUsuario')->name('usuario.editar');
            Route::post('/admin/usuarios/update', 'Sesion\AdminController@updateUsuario')->name('usuario.update');
            Route::delete('/admin/usuarios/eliminar/{id}', 'Sesion\AdminController@deleteUsuario')->name('usuario.eliminar');
            #   -   -   -   -   -   -   Funciones para Solicitudes
            Route::get('/admin/usuarios/solicitudes', 'Sesion\AdminController@solicitudes')->name('admin.solicitudes');
            Route::post('/admin/usuarios/solicitudes/aceptar', 'Sesion\AdminController@acceptSolicitud')->name('solicitudes.accept');
            Route::post('/admin/usuarios/solicitudes/check', 'Sesion\AdminController@checkUsername')->name('solicitudes.check');
            Route::delete('/admin/usuarios/solicitudes/eliminar/{id}', 'Sesion\AdminController@deleteSolicitud')->name('solicitud.eliminar');
            #   -   -   -   -   -   -   Funciones para Fotos(Galeria)
            Route::get('/admin/galeria', 'Sesion\AdminController@galeria')->name('admin.galeria');
            Route::get('/admin/galeria/nuevo', 'Sesion\AdminController@newFoto')->name('foto.new');
            Route::post('/admin/galeria/crear', 'Sesion\AdminController@createFoto')->name('foto.create');
            Route::delete('/admin/galeria/foto/eliminar/{id}', 'Sesion\AdminController@deleteFoto')->name('foto.eliminar');
    });
    #   -   -   -   -   -   -   Funciones para superusuarios
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
