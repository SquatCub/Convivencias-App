<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        $opcion = '';
        return view('login.index', compact('opcion'));
    }
}
