<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LandingController extends Controller
{
    public function index() {
        if($usuario = Auth::user()) {
            return view('principal.index', compact('usuario'));
        } else {
            return view('principal.index');
        }
    }
}
