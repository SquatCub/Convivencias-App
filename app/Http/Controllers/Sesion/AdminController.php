<?php

namespace App\Http\Controllers\Sesion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File; 
use Auth;
use Validator;
use App\Models\Categoria;
use App\Models\Actividad;

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
}
