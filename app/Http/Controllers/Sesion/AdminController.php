<?php

namespace App\Http\Controllers\Sesion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\Models\Categoria;

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
        $imgName = time().'.'.$r->imagen->getClientOriginalExtension();
        $r->imagen->move(public_path('images/categorias'), $imgName);
        $path = "categorias/".$imgName;

        try {
            if ($categoria = Categoria::where('nombre',$r->nombre)->count()>0) {
                return back()->with('error', 'Ya existe una categoría con este nombre');
            } else {
                if ($categoria = Categoria::create(["nombre"=>$r->nombre, "descripcion"=>$r->descripcion, "imagen"=>$path])) {
                    return redirect()->route('admin.categorias')->with('message', 'Categoría creada con exito');
                } else {
                    return back()->with('error', 'No se pudo crear la categoría');
                }
            }
        } catch (Exception $error) {
            return back()->with('error', 'Hubo un error');
        }
     }
    #   -   -   -   -   -   -   Funciones para Actividades
    public function actividades() {
        $categorias = Categoria::all();
        return view ('admin.actividades', compact('categorias'));
    }
}
