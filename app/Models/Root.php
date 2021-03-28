<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Root extends Model
{
    protected $table = 'root';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nombre', 'apellido_paterno', 'apellido_materno', 'id_usuario'];
    
    public function user(){
        return $this->hasOne(User::class, 'id', 'id_usuario');
    }
}
