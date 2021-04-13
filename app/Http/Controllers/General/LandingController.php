<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Categoria;
use App\Models\Actividad;
use App\Models\Area;

class LandingController extends Controller
{
    public function index() {
        $categorias = Categoria::all()->take(2);
        $actividades = Actividad::all();
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
}
