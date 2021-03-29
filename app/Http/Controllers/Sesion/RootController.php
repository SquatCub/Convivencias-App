<?php

namespace App\Http\Controllers\Sesion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\Models\Admin;
use App\Models\Area;

class RootController extends Controller
{
    public function inicio() {
        $root = Auth::user()->root;
        return view('root.index', compact('root'));
    }

    public function administradores() {
        $admins = Admin::all();
        return view('root.admins', compact('admins'));
    }

    public function secciones() {
        $areas = Area::all();
        return view('root.areas', compact('areas'));
    }
    #   -   -   -   -   -   -   Funciones para Secciones
    public function newSeccion() {
        return view('root.new_seccion');
    }
    public function createSeccion(Request $r) {
        $v = Validator::make($r->all(), [
            'nombre' => 'required',
        ]);
        try {
            if($area = Area::where('nombre',$r->nombre)->count()>0){
                return back()->with('error', 'Ya existe una seccion con este nombre');
            }else{
                if($area = Area::create($r->all())){
                    return redirect()->route('root.seccions')->with('mensaje', 'Area creada con exito');
                }else{
                    return back()->with('error', 'No se pudo crear el area');
                }
            }
        } catch (Exception $error) {
            return back()->with('error', 'Hubo un error');
        }
    }

}
