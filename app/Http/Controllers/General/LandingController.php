<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Categoria;
use App\Models\Actividad;
use App\Models\Area;
use App\Models\Comentario;
use App\Models\Foto;

class LandingController extends Controller
{
    // Funcion de la pagina principal, obteniendo categorias, actividades y fotos de la galeria
    public function index() {
        $categorias = Categoria::orderBy('id', 'desc')
        ->where('estado', 1)
        ->take(2)
        ->get();
        $actividades = Actividad::select('actividad.*')
        ->join('categoria', 'categoria.id', 'actividad.id_categoria')
        ->where('categoria.estado', 1)
        ->take(2)
        ->orderBy('id', 'desc')
        ->get();
        $fotos = Foto::orderBy('id', 'desc')->take(3)->get();
        $opt = "inicio";
        if($usuario = Auth::user()) {
            return view('principal.index', compact('usuario', 'categorias', 'actividades', 'fotos', 'opt'));
        } else {
            return view('principal.index', compact('categorias', 'actividades', 'fotos', 'opt'));
        }
    }
    // Alternar entre login y registro
    public function login($opcion) {
        $opt = "";
        if($opcion == "registro") {
            $opt = "registro";
        } else {
            $opt = "login";
        }
        $secciones = Area::orderBy('nombre', 'asc')->get();
        return view('login.index', compact('secciones', 'opcion', 'opt'));
    }
    //Obtener las categorias activas
    public function categorias() {
        $opt = "categorias";
        $categorias = Categoria::orderBy('id', 'desc')->get()->where('estado', 1);
        return view('principal.categorias', compact('categorias', 'opt'));
    }
    //Obtener actividades de una categoria
    public function verCategoria($categoria) {
        $opt = "categorias";
        if($categoria = Categoria::where('nombre', $categoria)->first()) {
            $actividades = Actividad::where('id_categoria', $categoria->id)->get();
            return view('principal.ver_categoria', compact('categoria', 'actividades', 'opt'));
        } else {
            return view('principal.no_encontrado', compact('opt'));
        }
    }
    //Obtener actividades con categorias activas
    public function actividades() {
        $opt = "actividades";
        $actividades = Actividad::select('actividad.*')
        ->join('categoria', 'categoria.id', 'actividad.id_categoria')
        ->where('categoria.estado', 1)
        ->take(2)
        ->orderBy('id', 'desc')
        ->get();
        return view('principal.actividades', compact('actividades', 'opt'));
    }
    //Abrir la actividad
    public function verActividad($actividad) {
        $opt = "actividades";
        if($actividad = Actividad::where('nombre', $actividad)->first()) {
            $comentarios = Comentario::where('id_actividad', $actividad->id)->get();
            return view('principal.ver_actividad', compact('actividad', 'comentarios', 'opt'));
        } else {
            return view('principal.no_encontrado', compact('opt'));
        }
    }
    //Obtener galeria de imagenes
    public function galeria() {
        $opt = "galeria";
        $fotos = Foto::orderBy('id', 'desc')->get();
        return view('principal.galeria', compact('fotos', 'opt'));
    }
}
