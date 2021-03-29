<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre', 'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function normal(){
        return $this->hasOne('App\Models\Usuario', 'id_usuario');
    }
    public function admin(){
        return $this->hasOne('App\Models\Admin', 'id_usuario');
    }
    public function root(){
        return $this->hasOne('App\Models\Root', 'id_usuario');
    }

    public function tipoUsuario(){
        if ($this->root){
            return 'R';
        } else if ($this->admin) {
            return 'A';
        } else if ($this->normal) {
            return 'U';
        }
        return 'O';
    }
}
