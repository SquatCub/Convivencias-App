<?php

namespace App\Http\Controllers\Sesion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File; 
use Auth;
use Validator;
use App\Models\Categoria;
use App\Models\Actividad;
use App\Models\Usuario;
use App\User;
use App\Models\Solicitud;
use App\Models\Area;

class AdminController extends Controller
{
    public function inicio() {
        $admin = Auth::user()->admin;
        return view('admin.index', compact('admin'));
    }
    #   -   -   -   -   -   -   Funciones para Categorias
     public function categorias() {
        $categorias = Categoria::all();
        return view('admin.categorias', compact('categorias'));
     }
     public function newCategoria() {
         return view('admin.new_categoria');
     }
     public function createCategoria(Request $r) {
        $v = Validator::make($r->all(), [
            'nombre' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required|image|mimes:jped,png,jpg,gif,svg|max:2048'
        ]);

        try {
            if ($categoria = Categoria::where('nombre',$r->nombre)->count()>0) {
                return back()->with('error', 'Ya existe una categoría con este nombre');
            } else {
                $imgName = time().'.'.$r->imagen->getClientOriginalExtension();
                $path = "categorias/".$imgName;
                if ($categoria = Categoria::create(["nombre"=>$r->nombre, "descripcion"=>$r->descripcion, "imagen"=>$path])) {
                     $r->imagen->move(public_path('images/categorias'), $imgName);
                     return redirect()->route('admin.categorias')->with('message', 'Categoría creada con exito');
                } else {
                    return back()->with('error', 'No se pudo crear la categoría');
                }
            }
        } catch (Exception $error) {
            return back()->with('error', 'Hubo un error');
        }
     }
     public function editCategoria($id) {
         $categoria = Categoria::findOrFail($id);
         return view ('admin.edit_categoria', compact('categoria'));
     }
     public function updateCategoria(Request $r) {
        $v = Validator::make($r->all(), [
            'id' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required',
        ]);
        try {
            $categoria = Categoria::findOrFail($r->id);
            if ($categoria->nombre == $r->nombre || !($repetido = Categoria::where('nombre', $r->nombre)->count()>0)) {
                $categoria->nombre=$r->nombre;
                $categoria->descripcion=$r->descripcion;
                if(!isset($r->imagen)) {
                    $categoria->imagen=$categoria->imagen;
                } else {
                    File::delete("images/".$categoria->imagen);
                    $imgName = time().'.'.$r->imagen->getClientOriginalExtension();
                    $path = "categorias/".$imgName;
                    $r->imagen->move(public_path('images/categorias'), $imgName);
                    $categoria->imagen=$path;
                }    
                $categoria->save();
                return redirect()->route('admin.categorias')->with('message', 'Categoría actualizada con éxito');
            } else {
                return back()->with('error', 'Ya existe una categoría con este nombre');
            }
        } catch (Exception $error) {
            return back()->with('error', 'Hubo un error');
        }
     }
     public function deleteCategoria($id) {
        if(!$id) {
            return back()->with('error', 'Hubo un error en la solicitud');
        }
        try {
             if($categoria = Categoria::findOrFail($id)) {
                 if(Actividad::where('id_categoria', $categoria->id)->count()>0) {
                     return back()->with('error', 'No se puede eliminar la categoría porque hay actividades asignadas a ella.');
                 }
                $categoria = Categoria::findOrFail($id);
                File::delete("images/".$categoria->imagen);
                Categoria::destroy($id);
                return back()->with('message', 'Categoría eliminada');   
             } else {
                 return back()->with('error', 'Recurso no encontrado');
             }
        } catch(Exception $e) {
            return back()->with('error', 'No es posible eliminar la categoría');
        }
     }
    #   -   -   -   -   -   -   Funciones para Actividades
    public function actividades() {
        $actividades = Actividad::all();
        return view ('admin.actividades', compact('actividades'));
    }
    public function newActividad() {
        $categorias = Categoria::all();
        return view('admin.new_actividad', compact('categorias'));
    }
    public function createActividad(Request $r) {
        $v = Validator::make($r->all(), [
            'nombre' => 'required',
            'id_categoria' => 'required',
            'descripcion' => 'required',
            'url' => 'required',
            'imagen' => 'required|image|mimes:jped,png,jpg,gif,svg|max:2048'
        ]);

        try {
            if ($actividad = Actividad::where('nombre',$r->nombre)->count()>0) {
                return back()->with('error', 'Ya existe una actividad con este nombre');
            } else {
                 $imgName = time().'.'.$r->imagen->getClientOriginalExtension();
                 $path = "actividades/".$imgName;
                 if ($actividad = Actividad::create(["nombre"=>$r->nombre, "descripcion"=>$r->descripcion, "imagen"=>$path, "video_url"=>$r->url, "id_categoria"=>$r->id_categoria])) {
                     $r->imagen->move(public_path('images/actividades'), $imgName);
                     return redirect()->route('admin.actividades')->with('message', 'Actividad creada con exito');
                 } else {
                     return back()->with('error', 'No se pudo crear la actividad');
                 }
                //return $r;
            }
        } catch (Exception $error) {
            return back()->with('error', 'Hubo un error');
        }
    }
    public function editActividad($id) {
        $categorias = Categoria::all();
        $actividad = Actividad::findOrFail($id);
        return view ('admin.edit_actividad', compact('actividad', 'categorias'));
    }
    public function updateActividad(Request $r) {
        $v = Validator::make($r->all(), [
            'nombre' => 'required',
            'id_actividad' => 'required',
            'id_categoria' => 'required',
            'descripcion' => 'required',
            'url' => 'required',
            'imagen' => 'required|image|mimes:jped,png,jpg,gif,svg|max:2048'
        ]);

        try {
            $actividad = Actividad::findOrFail($r->id_actividad);
            if ($actividad->nombre == $r->nombre || !($repetido = Actividad::where('nombre', $r->nombre)->count()>0)) {
                $actividad->nombre=$r->nombre;
                $actividad->descripcion=$r->descripcion;
                if(!isset($r->imagen)) {
                    $actividad->imagen=$actividad->imagen;
                } else {
                    File::delete("images/".$actividad->imagen);
                    $imgName = time().'.'.$r->imagen->getClientOriginalExtension();
                    $path = "actividades/".$imgName;
                    $r->imagen->move(public_path('images/actividades'), $imgName);
                    $actividad->imagen=$path;
                }    
                $actividad->save();
                return redirect()->route('admin.actividades')->with('message', 'Actividad actualizada con éxito');
            } else {
                return back()->with('error', 'Ya existe una actividad con este nombre');
            }
        } catch (Exception $error) {
            return back()->with('error', 'Hubo un error');
        }
    }
    public function deleteActividad($id) {
        if(!$id) {
            return back()->with('error', 'Hubo un error en la solicitud');
        }
        try {
             if($actividad = Actividad::findOrFail($id)) {
                $actividad = Actividad::findOrFail($id);
                File::delete("images/".$actividad->imagen);
                Actividad::destroy($id);
                return back()->with('message', 'Actividad eliminada');   
             } else {
                 return back()->with('error', 'Recurso no encontrado');
             }
        } catch(Exception $e) {
            return back()->with('error', 'No es posible eliminar la actividad');
        }
    }
    #   -   -   -   -   -   -   Funciones para Usuarios
    public function usuarios() {
        $usuarios = Usuario::all();
        $categorias = Categoria::all();
        return view('admin.usuarios', compact('usuarios', 'categorias'));
    }
    public function solicitudes() {
        $solicitudes = Solicitud::all();
        return view('admin.solicitudes', compact('solicitudes'));
    }
    public function acceptSolicitud(Request $r) {
        $solicitud = Solicitud::where('id', $r->solicitud_id)->get();
        $area = Area::where('id', $solicitud[0]->id_area)->get();

        try {
            if ($user = User::where('usuario', $solicitud[0]->usuario)->count()>0) {
                return back()->with('error', 'Ya existe un usuario con este álias');
            } else {
                if ($user = User::create(["usuario"=>$solicitud[0]->usuario, "password"=>bcrypt($solicitud[0]->contraseña)])) {
                    if ($usuario = Usuario::create(["nombre"=>$solicitud[0]->nombre, "apellido_paterno"=>$solicitud[0]->apellido_paterno, "apellido_materno"=>$solicitud[0]->apellido_materno, "id_usuario"=>$user->id, "id_area"=>$solicitud[0]->id_area])) {
                        Solicitud::destroy($r->solicitud_id);
                        return response()->json([0 => $solicitud[0], 1 => $area[0]]);
                    } else {
                        return back()->with('error', 'No se pudo crear el administrador');
                    }
                } else {
                    return back()->with('error', 'No se pudo crear el usuario');
                }
            }
        } catch (Exception $error) {
            return back()->with('error', 'Hubo un error');
        }
    }

}
