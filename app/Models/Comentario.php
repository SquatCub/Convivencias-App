<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Comentario extends Model
{
    protected $table = 'comentario';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'path', 'tipo', 'id_usuario', 'id_actividad'];

    public function user() {
        return $this->hasOne(User::class, 'id', 'id_usuario');
    }
    public function usuario() {
        return $this->user->normal();
    }
}
