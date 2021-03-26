<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Solicitud;
use Validator;

class SolicitudController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function enviarSolicitud(Request $request) {
        $v = Validator::make($request->all(), [
            'username' => 'required',
            'img_url' => 'required|image|mimes:jped,png,jpg,gif,svg|max:2048'
        ]);
        $imgName = time().'.'.$request->acta->getClientOriginalExtension();
        $request->acta->move(public_path('images'), $imgName);

        if($solicitud = Solicitud::create(["username"=>$request->username, "img_url"=>$imgName])){
            return redirect()->route('index');
        } else {
            return ("Nop");
        }
    }
}
