<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    protected $fillable = [
        'nombre',
        'ciclo',
        'carrera_id'
    ];
}