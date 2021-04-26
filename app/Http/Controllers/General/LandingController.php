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
        if($usuario = Auth::user()) {
            return view('principal.index', compact('usuario', 'categorias', 'actividades'));
        } else {
            return view('principal.index', compact('categorias', 'actividades'));
        }
    }
    public function login($opcion) {
        $secciones = Area::all();
        return view('login.index', compact('secciones', 'opcion'));
    }

    public function categorias() {
        $categorias = Categoria::all();
        return view('principal.categorias', compact('categorias'));
    }
    public function actividades() {
        $actividades = Actividad::orderBy('id', 'desc')->get();
        return view('principal.actividades', compact('actividades'));
    }
    public function verActividad($actividad) {
        if($actividad = Actividad::where('nombre', $actividad)->first()) {
            $comentarios = Comentario::where('id_actividad', $actividad->id)->get();
            return view('principal.ver_actividad', compact('actividad', 'comentarios'));
        } else {
            return view('principal.no_encontrado');
        }
    }
}
