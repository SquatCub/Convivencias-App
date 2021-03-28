<?php

namespace App\Http\Controllers\Sesion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class UsuarioController extends Controller
{
    public function inicio() {
        $usuario = Auth::user()->usuario;
        return view('principal.index', compact('usuario'));
    }
}
