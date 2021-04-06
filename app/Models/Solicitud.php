<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Area;

class Solicitud extends Model
{
    protected $table = 'solicitud';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nombre', 'apellido_paterno', 'apellido_materno', 'usuario', 'contraseña', 'url_acta', 'url_comprobante', 'email', 'telefono', 'id_area'];

    public function area() {
        return $this->hasOne(Area::class, 'id', 'id_area');
    }
}
