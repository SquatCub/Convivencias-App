<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\User;

class Usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nombre', 'apellido_paterno', 'apellido_materno', 'id_usuario', 'id_area'];
    public function area(){
        return $this->hasOne(Area::class, 'id', 'id_area');
    }
    public function user(){
        return $this->hasOne(User::class, 'id', 'id_usuario');
    }
}
