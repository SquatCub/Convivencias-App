<?php

namespace App\Http\Controllers\Sesion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminController extends Controller
{
    public function inicio() {
        $admin = Auth::user()->admin;
        return view('admin.index', compact('admin'));
    }
}
