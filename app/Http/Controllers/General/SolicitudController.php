<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Solicitud;
use App\User;
use Validator;

class SolicitudController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function enviarSolicitud(Request $r) {
        $v = Validator::make($r->all(), [
            'name' => 'required',
            'paterno' => 'required',
            'id_seccion' => 'required',
            'username' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'acta' => 'required|image|mimes:jped,png,jpg,gif,svg|max:2048',
            'comprobante' => 'required|image|mimes:jped,png,jpg,gif,svg|max:2048'
        ]);
        try {
            if($usuario = User::where('usuario', $r->username)->count()>0) {
                return back()->with('error', 'Ya existe un usuario con este álias');
            } else {
                $acta = time().'.'.$r->acta->getClientOriginalExtension();
                $comprobante = time().'.'.$r->comprobante->getClientOriginalExtension();

                $pathActa = "actas/".$acta;
                $pathComprobante = "comprobantes/".$comprobante;

                if($solicitud = Solicitud::create(["nombre"=>$r->name, "apellido_paterno"=>$r->paterno, "apellido_materno"=>$r->materno, "usuario"=>$r->username, "contraseña"=>$r->password, "url_acta"=>$pathActa,  "url_comprobante"=>$pathComprobante,  "id_area"=>$r->id_seccion, "email"=>$r->email, "telefono"=>$r->phone])){
                    $r->acta->move(public_path('images/actas/'), $acta);
                    $r->comprobante->move(public_path('images/comprobantes/'), $comprobante);
                    return back()->with('message', 'Solicitud enviada con éxito');
                } else {
                    return back()->with('error', 'Error al enviar la solicitud');
                }
            }
        } catch(Exception $error) {
            return back()->with('error', 'Hubo un error');
        }
    }
}
