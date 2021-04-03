<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
class LoginController extends Controller
{
    public function index() {
        $opcion = '';
        $secciones = Area::all();
        return view('login.index', compact('opcion', 'secciones'));
    }
}
