<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Categoria;
use App\Models\Actividad;
use App\Models\Area;
use App\Models\Comentario;

class LandingController extends Controller
{
    public function index() {
        $categorias = Categoria::all()->take(2);
        $actividades = Actividad::all()->take(2);
        $opt = "inicio";
        if($usuario = Auth::user()) {
            return view('principal.index', compact('usuario', 'categorias', 'actividades', 'opt'));
        } else {
            return view('principal.index', compact('categorias', 'actividades', 'opt'));
        }
    }
    public function login($opcion) {
        $opt = "";
        if($opcion == "registro") {
            $opt = "registro";
        } else {
            $opt = "login";
        }
        
        $secciones = Area::all();
        return view('login.index', compact('secciones', 'opcion', 'opt'));
    }

    public function categorias() {
        $opt = "categorias";
        $categorias = Categoria::all();
        return view('principal.categorias', compact('categorias', 'opt'));
    }
    public function verCategoria($categoria) {
        $opt = "categorias";
        if($categoria = Categoria::where('nombre', $categoria)->first()) {
            $actividades = Actividad::where('id_categoria', $categoria->id)->get();
            return view('principal.ver_categoria', compact('categoria', 'actividades', 'opt'));
        } else {
            return view('principal.no_encontrado', compact('opt'));
        }
    }
    public function actividades() {
        $opt = "actividades";
        $actividades = Actividad::orderBy('id', 'desc')->get();
        return view('principal.actividades', compact('actividades', 'opt'));
    }
    public function verActividad($actividad) {
        $opt = "actividades";
        if($actividad = Actividad::where('nombre', $actividad)->first()) {
            $comentarios = Comentario::where('id_actividad', $actividad->id)->get();
            return view('principal.ver_actividad', compact('actividad', 'comentarios', 'opt'));
        } else {
            return view('principal.no_encontrado', compact('opt'));
        }
    }
}
