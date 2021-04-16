<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentario';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'imagen', 'id_usuario', 'id_actividad'];

    public function user() {
        return $this->hasOne(User::class, 'id', 'id_usuario');
    }
}
