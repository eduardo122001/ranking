<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $fillable = [

        'estudiante_id',

        'semestre_id',

        'carrera_id',

        'semestre_estudiante',

        'rendimiento',

        'comportamiento',

        'pagos',

        'referente',

        'promedio',

        'ranking'
    ];
// retorno de valores en claves foraneas $nota->estudiante->nombre
    public function estudiante()
    {
        return $this->belongsTo(User::class, 'estudiante_id');
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }

}