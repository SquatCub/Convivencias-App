<?php

namespace App\Http\Controllers\Sesion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\Models\Admin;
use App\Models\Usuario;
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
            if ($user = User::where('usuario',$r->username)->count()>0) {
                return back()->with('error', 'Ya existe un usuario con este álias');
            } else {
                if ($user = User::create(["usuario"=>$r->username, "password"=>bcrypt($r->password)])) {
                    if ($admin = Admin::create(["nombre"=>$r->nombre, "apellido_paterno"=>$r->paterno, "apellido_materno"=>$r->materno, "id_usuario"=>$user->id, "id_area"=>$r->id_area])) {
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
    public function editAdmin($id) {
        $admin = Admin::findOrFail($id);
        $areas = Area::all();
        return view('root.edit_admin', compact('admin', 'areas'));
    }
    public function updateAdmin(Request $r) {
        $v = Validator::make($r->all(), [
            'nombre' => 'required',
            'materno' => 'required',
            'paterno' => 'required',
            'username' => 'required',
            'password' => 'required',
            'id_area' => 'required',
            'id_usuario' => 'required',
            'id_admin' => 'required'
        ]);
        try {
            $usuario = User::findOrFail($r->id_usuario);
            $admin = Admin::findOrFail($r->id_admin);
            if ($usuario->usuario == $r->username || !($user = User::where('usuario',$r->username)->count()>0)) {
                $usuario->usuario=$r->username;
                $usuario->password=bcrypt($r->password);
                $usuario->save();
                $admin->nombre=$r->nombre;
                $admin->apellido_paterno=$r->paterno;
                $admin->apellido_materno=$r->materno;
                $admin->id_area=$r->id_area;
                $admin->save();
                return redirect()->route('root.admins')->with('message', 'Administrador actualizado con exito');
            } else {
                return back()->with('error', 'Ya existe un usuario con este álias');
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
            if ($area = Area::where('nombre',$r->nombre)->count()>0) {
                return back()->with('error', 'Ya existe una seccion con este nombre');
            } else {
                if ($area = Area::create($r->all())) {
                    return redirect()->route('root.seccions')->with('message', 'Area creada con exito');
                } else {
                    return back()->with('error', 'No se pudo crear el area');
                }
            }
        } catch (Exception $error) {
            return back()->with('error', 'Hubo un error');
        }
    }
    public function editSeccion($id) {
        $seccion = Area::findOrFail($id);
        return view('root.edit_seccion', compact('seccion'));
    }
    public function updateSeccion(Request $r){
        $v = Validator::make($r->all(), [
            'id' => 'required',
            'nombre'=> 'required',
        ]);
        if ($v->fails()) {
            return back()->with('error', 'Llene todos los campos');
        }
        try {
            if ($area = Area::findOrFail($r->id)) {
                if (!($areas = Area::where('nombre', $r->nombre)->count()>0)) {
                    $area->nombre=$r->nombre;
                    $area->save();
                    return redirect()->route('root.seccions')->with('message', 'Area actualizada con exito');
                } else {
                    return back()->with('error', 'Ya existe una sección con este nombre');
                }  
            } else {
                return back()->with('error', 'No se pudo actualizar el área');
            }
        } catch (Exception $error) {
            return back()->with('error', 'Hubo un error desconocido');
        }
    }
    public function deleteSeccion($id) {
        if(!$id) {
            return back()->with('error', 'Hubo un error en la solicitud');
        }
        try {
            if($area = Area::findOrFail($id)) {
                if(Admin::where('id_area', $area->id)->count()>0 || Usuario::where('id_area', $area->id)->count()>0) {
                    return back()->with('error', 'No se puede eliminar la sección porque hay usuarios asignados a ella.');
                }
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
            if($user = User::where('usuario',$r->username)->count()>0) {
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
    public function editRoot($id) {
        $root = Root::findOrFail($id);
        return view('root.edit_root', compact('root'));
    }
    public function updateRoot(Request $r) {
        $v = Validator::make($r->all(), [
            'nombre' => 'required',
            'materno' => 'required',
            'paterno' => 'required',
            'username' => 'required',
            'password' => 'required',
            'id_usuario' => 'required',
            'id_root' => 'required'
        ]);
        try {
            $usuario = User::findOrFail($r->id_usuario);
            $root = Root::findOrFail($r->id_root);
            if ($usuario->usuario == $r->username || !($user = User::where('usuario',$r->username)->count()>0)) {
                $usuario->usuario=$r->username;
                $usuario->password=bcrypt($r->password);
                $usuario->save();
                $root->nombre=$r->nombre;
                $root->apellido_paterno=$r->paterno;
                $root->apellido_materno=$r->materno;
                $root->save();
                return redirect()->route('root.superusers')->with('message', 'Superusuario actualizado con exito');
            } else {
                return back()->with('error', 'Ya existe un usuario con este álias');
            }
        } catch (Exception $error) {
            return back()->with('error', 'Hubo un error');
        }
    }
    public function deleteRoot($id) {
        if(!$id) {
            return back()->with('error', 'Hubo un error en la solicitud');
        }
        try {
            if(User::findOrFail($id)) {
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
