<?php

namespace App\Http\Controllers\Sesion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class RootController extends Controller
{
    public function inicio() {
        $root = Auth::user()->root;
        return view('root.index', compact('root'));
    }
}
