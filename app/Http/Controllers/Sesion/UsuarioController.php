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
    // Funcion para hacer un comentario
    public function createComentario(Request $r) {
        $v = Validator::make($r->all(), [
            'file' => 'required',
            'tipo' => 'required',
            'id_actividad' => 'required',
            'id_usuario' => 'required'
        ]);
        try {
            if ($comentario = Comentario::where('id_usuario',$r->id_usuario)->where('id_actividad', $r->id_actividad)->count()>0) {
                return back()->with('error', 'Ya compartiste anteriormente');
            } else {
                if($r->tipo == "imagen") {
                    $fileName = time().'.'.$r->file->getClientOriginalExtension();
                    $path = "comentarios/".$fileName;
                    if ($comentario = Comentario::create(["path"=>$path, "tipo"=>$r->tipo, "id_usuario"=>$r->id_usuario, "id_actividad"=>$r->id_actividad])) {
                        $r->file->move(public_path('images/comentarios'), $fileName);
                        return back()->with('message', 'Compartiste tu trabajo!');
                    } else {
                        return back()->with('error', 'No se pudo compartir');
                    }
                } else {
                    $fileName = time().'.'.$r->file->getClientOriginalExtension();
                    $path = "comentarios/".$fileName;
                    if ($comentario = Comentario::create(["path"=>$path, "tipo"=>$r->tipo, "id_usuario"=>$r->id_usuario, "id_actividad"=>$r->id_actividad])) {
                        $r->file->move(public_path('videos/comentarios'), $fileName);
                        return back()->with('message', 'Compartiste tu trabajo!');
                   } else {
                      return back()->with('error', 'No se pudo compartir');
                  }
                }
                 
                 
            }
        } catch (Exception $error) {
            return back()->with('error', 'Hubo un error');
        }
    }
}
