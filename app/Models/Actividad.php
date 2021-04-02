<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
class Actividad extends Model
{
    protected $table = 'actividad';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nombre', 'descripcion', 'imagen', 'video_url'];

    public function categoria() {
        return $this->belongsTo(Categoria::class, 'id', 'id_categoria');
    }
}
