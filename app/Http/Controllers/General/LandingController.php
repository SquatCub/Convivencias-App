<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Categoria;

class LandingController extends Controller
{
    public function index() {
        $categorias = Categoria::all();
        if($usuario = Auth::user()) {
            return view('principal.index', compact('usuario', 'categorias'));
        } else {
            return view('principal.index', compact('categorias'));
        }
    }
}
