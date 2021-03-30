<?php

namespace App\Http\Controllers\Sesion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\Models\Admin;
use App\Models\Area;
use App\Models\Root;
use App\User;

class RootController extends Controller
{
    public function inicio() {
        $root = Auth::user()->root;
        return view('root.index', compact('root'));
    }

    #   -   -   -   -   -   -   Funciones para Administradores
    public function administradores() {
        $admins = Admin::all();
        return view('root.admins', compact('admins'));
    }
    public function newAdmin() {
        $areas = Area::all();
        return view('root.new_admin', compact('areas'));
    }
    public function createAdmin(Request $r) {
        $v = Validator::make($r->all(), [
            'nombre' => 'required',
            'materno' => 'required',
            'paterno' => 'required',
            'username' => 'required',
            'password' => 'required',
            'id_area' => 'required'
        ]);
        try {
            if($user = User::where('usuario',$r->username)->count()>0){
                return back()->with('error', 'Ya existe un usuario con este álias');
            }else{
                if($user = User::create(["usuario"=>$r->username, "password"=>bcrypt($r->password)])) {
                    if($admin = Admin::create(["nombre"=>$r->nombre, "apellido_paterno"=>$r->paterno, "apellido_materno"=>$r->materno, "id_usuario"=>$user->id, "id_area"=>$r->id_area])) {
                        return redirect()->route('root.admins')->with('message', 'Administrador creado con exito');
                    } else {
                        return back()->with('error', 'No se pudo crear el administrador');
                    }
                } else {
                    return back()->with('error', 'No se pudo crear el administrador');
                }
            }
        } catch (Exception $error) {
            return back()->with('error', 'Hubo un error');
        }
    }
    public function deleteAdmin($id) {
        if(!$id){
            return back()->with('error', 'Hubo un error en la solicitud');
        }
        try {
            if(User::findOrFail($id)){
                User::destroy($id);
                return back()->with('message', 'Administrador eliminado');            
            } else {
                return back()->with('error', 'Recurso no encontrado');
            }
        } catch(Exception $e) {
            return back()->with('error', 'No es posible eliminar al administrador');
        }
    }
    
    #   -   -   -   -   -   -   Funciones para Secciones
    public function secciones() {
        $areas = Area::all();
        return view('root.areas', compact('areas'));
    }
    public function newSeccion() {
        return view('root.new_seccion');
    }
    public function createSeccion(Request $r) {
        $v = Validator::make($r->all(), [
            'nombre' => 'required',
        ]);
        try {
            if($area = Area::where('nombre',$r->nombre)->count()>0){
                return back()->with('error', 'Ya existe una seccion con este nombre');
            }else{
                if($area = Area::create($r->all())){
                    return redirect()->route('root.seccions')->with('message', 'Area creada con exito');
                }else{
                    return back()->with('error', 'No se pudo crear el area');
                }
            }
        } catch (Exception $error) {
            return back()->with('error', 'Hubo un error');
        }
    }
    public function deleteSeccion($id) {
        if(!$id){
            return back()->with('error', 'Hubo un error en la solicitud');
        }
        try {
            if(Area::findOrFail($id)){
                Area::destroy($id);
                return back()->with('message', 'Sección eliminada');            
            } else {
                return back()->with('error', 'Recurso no encontrado');
            }
        } catch(Exception $e) {
            return back()->with('error', 'No es posible eliminar la sección');
        }
    }
    #   -   -   -   -   -   -   Funciones para Superusuarios
    public function superusers() {
        $roots = Root::all();
        return view('root.superusuarios', compact('roots'));
    }
    public function newRoot() {
        return view('root.new_root');
    }
    public function createRoot(Request $r) {
        $v = Validator::make($r->all(), [
            'nombre' => 'required',
            'materno' => 'required',
            'paterno' => 'required',
            'username' => 'required',
            'password' => 'required'
        ]);
        try {
            if($user = User::where('usuario',$r->username)->count()>0){
                return back()->with('error', 'Ya existe un usuario con este álias');
            }else{
                if($user = User::create(["usuario"=>$r->username, "password"=>bcrypt($r->password)])) {
                    if($admin = Root::create(["nombre"=>$r->nombre, "apellido_paterno"=>$r->paterno, "apellido_materno"=>$r->materno, "id_usuario"=>$user->id])) {
                        return redirect()->route('root.superusers')->with('message', 'Superusuario creado con exito');
                    } else {
                        return back()->with('error', 'No se pudo crear el superusuario');
                    }
                } else {
                    return back()->with('error', 'No se pudo crear el superusuario');
                }
            }
        } catch (Exception $error) {
            return back()->with('error', 'Hubo un error');
        }
    }
    public function deleteRoot($id) {
        if(!$id){
            return back()->with('error', 'Hubo un error en la solicitud');
        }
        try {
            if(User::findOrFail($id)){
                User::destroy($id);
                return back()->with('message', 'Superusuario eliminado');            
            } else {
                return back()->with('error', 'Recurso no encontrado');
            }
        } catch(Exception $e) {
            return back()->with('error', 'No es posible eliminar al superusuario');
        }
    }

}
