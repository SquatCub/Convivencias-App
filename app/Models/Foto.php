<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'foto';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'imagen'];
}
