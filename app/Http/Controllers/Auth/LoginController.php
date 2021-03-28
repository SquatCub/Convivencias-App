<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    public function login() {
        $credentials = $this->validate(request(), [
            'usuario' => 'required|string',
            'password' => 'required|string'
        ]);
        if (Auth::attempt($credentials)) {
            switch (Auth::user()->tipoUsuario()) {
                case 'U':
                    return "Usuario";
                    break;
                case 'A':
                    return "Admin";
                    break;
                case 'R':
                    return "Root";
                    break;
                default:
                    return redirect()->back()->withErrors(['usuario' => trans('auth.failed')])
                    ->withInput(['usuario' => $credentials['usuario']]);
                    break;
            }
        }
        
        return redirect()->back()->withErrors(['usuario' => trans('auth.failed')])
        ->withInput(['usuario' => $credentials['usuario']]);
    }
}
