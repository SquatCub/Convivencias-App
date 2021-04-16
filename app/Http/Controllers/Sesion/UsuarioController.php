<?php

namespace App\Http\Controllers\Sesion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\User;
use App\Models\Comentario;
use App\Models\Actividad;

class UsuarioController extends Controller
{
    public function inicio() {
        $usuario = Auth::user();
        return view('principal.index', compact('usuario'));
    }

    public function createComentario(Request $r) {
        $v = Validator::make($r->all(), [
            'imagen' => 'required|image|mimes:jped,png,jpg,gif,svg|max:2048',
            'id_actividad' => 'required',
            'id_usuario' => 'required'
        ]);

        try {
            if ($comentario = Comentario::where('id_usuario',$r->id_usuario)->count()>0) {
                return back()->with('error', 'Ya compartiste anteriormente');
            } else {
                 $imgName = time().'.'.$r->imagen->getClientOriginalExtension();
                 $path = "comentarios/".$imgName;
                 if ($comentario = Comentario::create(["imagen"=>$path, "id_usuario"=>$r->id_usuario, "id_actividad"=>$r->id_actividad])) {
                      $r->imagen->move(public_path('images/comentarios'), $imgName);
                      return back()->with('message', 'Compartiste tu trabajo!');
                 } else {
                    return back()->with('error', 'No se pudo compartir');
                }
            }
        } catch (Exception $error) {
            return back()->with('error', 'Hubo un error');
        }
    }
}
