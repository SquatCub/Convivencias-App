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
use App\Models\Comentario;
use App\Models\Foto;

class AdminController extends Controller
{
    public function inicio() {
        $admin = Auth::user()->admin;
        return view('admin.index', compact('admin'));
    }
    #   -   -   -   -   -   -   Funciones para Categorias
     public function categorias() {
        $categorias = Categoria::orderBy('nombre', 'asc')->get();
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
            'estado' => 'required',
            'imagen' => 'required',
        ]);
        try {
            $categoria = Categoria::findOrFail($r->id);
            if ($categoria->nombre == $r->nombre || !($repetido = Categoria::where('nombre', $r->nombre)->count()>0)) {
                $categoria->nombre=$r->nombre;
                $categoria->descripcion=$r->descripcion;
                $categoria->estado=$r->estado;
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

     public function actividadCategoria($categoria) {
        if($categoria = Categoria::where('nombre', $categoria)->first()) {
            $actividades = Actividad::where('id_categoria', $categoria->id)->get();
            return view('admin.actividades', compact('actividades','categoria'));
        } else {
            return view('principal.no_encontrado');
        }
    }
    #   -   -   -   -   -   -   Funciones para Actividades
    public function actividades() {
        $actividades = Actividad::orderBy('nombre', 'asc')->get();
        return view ('admin.actividades', compact('actividades'));
    }
    public function newActividad() {
        $categorias = Categoria::orderBy('nombre', 'asc')->get();
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
        $url = getUrl($r->url);
        try {
            if ($actividad = Actividad::where('nombre',$r->nombre)->count()>0) {
                return back()->with('error', 'Ya existe una actividad con este nombre');
            } else {
                 $imgName = time().'.'.$r->imagen->getClientOriginalExtension();
                 $path = "actividades/".$imgName;
                 if ($actividad = Actividad::create(["nombre"=>$r->nombre, "descripcion"=>$r->descripcion, "imagen"=>$path, "video_url"=>$url, "id_categoria"=>$r->id_categoria])) {
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
        $categorias = Categoria::orderBy('nombre', 'asc')->get();
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
        $url = getUrl($r->url);
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
                $actividad->video_url = $url;
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
    public function verActividad($id) {
        $actividad = Actividad::findOrFail($id);
        $comentarios = Comentario::where('id_actividad', $actividad->id)->get();
        return view ('admin.ver_actividad', compact('actividad', 'comentarios'));
    }
    public function deleteComentario($id) {
        if(!$id) {
            return back()->with('error', 'Hubo un error en la solicitud');
        }
        try {
             if($comentario = Comentario::findOrFail($id)) {
                $comentario = Comentario::findOrFail($id);
                if($comentario->tipo == "imagen") {
                    File::delete("images/".$comentario->path);
                }
                elseif ($comentario->tipo == "video") {
                    File::delete("videos/".$comentario->path);
                }
                Comentario::destroy($id);
                return back()->with('message', 'Imagen eliminada correctamente');   
             } else {
                 return back()->with('error', 'Recurso no encontrado');
             }
        } catch(Exception $e) {
            return back()->with('error', 'No es posible eliminar el comentario');
        }
    }
    #   -   -   -   -   -   -   Funciones para manejo de Usuarios
    public function usuarios() {
        $usuarios = Usuario::orderBy('nombre', 'asc')->get();
        return view('admin.usuarios', compact('usuarios'));
    }
    public function newUsuario() {
        $areas = Area::orderBy('nombre', 'asc')->get();
        return view('admin.new_usuario', compact('areas'));
    }
    public function createUsuario(Request $r) {
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
                    if ($usuario = Usuario::create(["nombre"=>$r->nombre, "apellido_paterno"=>$r->paterno, "apellido_materno"=>$r->materno, "id_usuario"=>$user->id, "id_area"=>$r->id_area,"centro_trabajo"=>$r->centro, "telefono"=>$r->telefono, "edad"=>$r->edad, "sexo"=>$r->sexo])) {
                        return redirect()->route('admin.usuarios')->with('message', 'Usuario creado con exito');
                    } else {
                        return back()->with('error', 'No se pudo crear el usuario');
                    }
                } else {
                    return back()->with('error', 'No se pudo crear el usuario');
                }
            }
        } catch (Exception $error) {
            return back()->with('error', 'Hubo un error');
        }
    }
    public function editUsuario($id) {
        $usuario = Usuario::findOrFail($id);
        $areas = Area::all();
        return view('admin.edit_usuario', compact('usuario', 'areas'));
    }
    public function updateUsuario(Request $r) {
        $v = Validator::make($r->all(), [
            'nombre' => 'required',
            'materno' => 'required',
            'paterno' => 'required',
            'username' => 'required',
            'password' => 'required',
            'id_area' => 'required',
            'id_user' => 'required',
            'id_usuario' => 'required'
        ]);
        try {
            $user = User::findOrFail($r->id_user);
            $usuario = Usuario::findOrFail($r->id_usuario);
            if ($user->usuario == $r->username || !($new_user = User::where('usuario',$r->username)->count()>0)) {
                $user->usuario=$r->username;
                $user->password=bcrypt($r->password);
                $user->save();
                $usuario->nombre=$r->nombre;
                $usuario->apellido_paterno=$r->paterno;
                $usuario->apellido_materno=$r->materno;
                $usuario->id_area=$r->id_area;
                $usuario->save();
                return redirect()->route('admin.usuarios')->with('message', 'Usuario actualizado con exito');
            } else {
                return back()->with('error', 'Ya existe un usuario con este álias');
            }
        } catch (Exception $error) {
            return back()->with('error', 'Hubo un error');
        }
    }
    public function deleteUsuario($id) {
        if(!$id){
            return back()->with('error', 'Hubo un error en la solicitud');
        }
        try {
            if($usuario = Usuario::findOrFail($id)){
                $user = User::where('id', $usuario->id_usuario)->first();
                
                $comentarios = Comentario::where('id_usuario', $usuario->id_usuario)->get();
                foreach ($comentarios as $comentario) {
                    File::delete("images/".$comentario->path);
                    File::delete("videos/".$comentario->path);
                }
                User::destroy($user->id);
                return back()->with('message', 'Usuario eliminado');            
            } else {
                return back()->with('error', 'Recurso no encontrado');
            }
        } catch(Exception $e) {
            return back()->with('error', 'No es posible eliminar al usuario');
        }
    }
    public function solicitudes() {
        $solicitudes = Solicitud::all();
        return view('admin.solicitudes', compact('solicitudes'));
    }
    public function checkUsername(Request $r) {
        if ($user = User::where('usuario', $r->username)->count()>0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Usuario no disponible',
            ]);
        } else {
            return response()->json([
                'status' => 'correcto',
                'message' => 'Usuario disponible',
            ]);
        }
    }
    public function acceptSolicitud(Request $r) {
        $solicitud = Solicitud::where('id', $r->solicitud_id)->get();
        $area = Area::where('id', $solicitud[0]->id_area)->get();

        try {
            if ($user = User::where('usuario', $r->username)->count()>0) {
                return response()->json([
                    'status' => 'Error',
                    'message' => 'Usuario no disponible',
                ]);
            } else {
                if ($user = User::create(["usuario"=>$r->username, "password"=>bcrypt($solicitud[0]->contraseña)])) {
                    if ($usuario = Usuario::create(["nombre"=>$solicitud[0]->nombre, "apellido_paterno"=>$solicitud[0]->apellido_paterno, "apellido_materno"=>$solicitud[0]->apellido_materno, "id_usuario"=>$user->id, "id_area"=>$solicitud[0]->id_area,"centro_trabajo"=>$solicitud[0]->centro_trabajo, "telefono"=>$solicitud[0]->telefono, "edad"=>$solicitud[0]->edad, "sexo"=>$solicitud[0]->sexo])) {
                        File::delete("images/".$solicitud[0]->url_acta);
                        File::delete("images/".$solicitud[0]->url_comprobante);
                        Solicitud::destroy($r->solicitud_id);
                        $solicitud[0]->usuario = $r->username;
                        if (!$solicitud[0]->email) {
                            $solicitud[0]->email = "No registrado";
                        }
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
    public function deleteSolicitud($id) {
        if(!$id) {
            return back()->with('error', 'Hubo un error en la solicitud');
        }
        try {
             if($solicitud = Solicitud::findOrFail($id)) {
                $solicitud = Solicitud::findOrFail($id);
                File::delete("images/".$solicitud->url_acta);
                File::delete("images/".$solicitud->url_comprobante);
                Solicitud::destroy($id);
                return back()->with('message', 'Solicitud rechazada');   
             } else {
                 return back()->with('error', 'Recurso no encontrado');
             }
        } catch(Exception $e) {
            return back()->with('error', 'No es posible eliminar la solicitud');
        }
    }

    #   -   -   -   -   -   -   Funciones para Galeria
    public function galeria() {
        $fotos = Foto::orderBy('id', 'desc')->get();
        return view('admin.galeria', compact('fotos'));
    }
    public function newFoto() {
        return view('admin.new_foto');
    }
    public function createFoto(Request $r) {
        $v = Validator::make($r->all(), [
            'imagen' => 'required|image|mimes:jped,png,jpg,gif,svg|max:2048'
        ]);

        try {
            $imgName = time().'.'.$r->imagen->getClientOriginalExtension();
            $path = "galeria/".$imgName;
            if ($foto = Foto::create(["imagen"=>$path])) {
                    $r->imagen->move(public_path('images/galeria'), $imgName);
                    return redirect()->route('admin.galeria')->with('message', 'Imagen añadída con éxito');
            } else {
                return back()->with('error', 'No se pudo agregar la imagen');
            }
        } catch (Exception $error) {
            return back()->with('error', 'Hubo un error');
        }
     }
     public function deleteFoto($id) {
        if(!$id) {
            return back()->with('error', 'Hubo un error en la solicitud');
        }
        try {
             if($foto = Foto::findOrFail($id)) {
                $foto = Foto::findOrFail($id);
                File::delete("images/".$foto->imagen);
                Foto::destroy($id);
                return back()->with('message', 'Imagen eliminada');   
             } else {
                 return back()->with('error', 'Recurso no encontrado');
             }
        } catch(Exception $e) {
            return back()->with('error', 'No es posible eliminar la imagen');
        }
     }
}
//  Funcion para recortar el URL del video compartido
function getUrl($video_url) {
    $url= "";
    $len = strlen($video_url);
    for ($i = $len-1; $i >= 0; $i--) {
        if($video_url[$i] == "/" || $video_url[$i] == "=") {
            break;
        }
        $url .= $video_url[$i];
    }
    $url = strrev($url);
    return $url;
}