<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

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

    // Obliga a Laravel a tratar estos campos como flotantes nativos
    protected $casts = [
        'rendimiento' => 'float',
        'comportamiento' => 'float',
        'pagos' => 'float',
        'referente' => 'float',
        'promedio' => 'float',
    ];

    // ACCESSORS: Aseguran que cada vez que llames a la nota, devuelva dos decimales (Ej: 20.00 o 15.50)
    protected function rendimiento(): Attribute
    {
        return Attribute::make(get: fn ($value) => number_format((float)$value, 2, '.', ''));
    }

    protected function comportamiento(): Attribute
    {
        return Attribute::make(get: fn ($value) => number_format((float)$value, 2, '.', ''));
    }

    protected function pagos(): Attribute
    {
        return Attribute::make(get: fn ($value) => number_format((float)$value, 2, '.', ''));
    }

    protected function referente(): Attribute
    {
        return Attribute::make(get: fn ($value) => number_format((float)$value, 2, '.', ''));
    }

    protected function promedio(): Attribute
    {
        return Attribute::make(get: fn ($value) => number_format((float)$value, 2, '.', ''));
    }

    // Retorno de valores en claves foráneas
    public function estudiante()
    {
        return $this->belongsTo(User::class, 'estudiante_id');
    }

    public function semestre()
    {
        return $this->belongsTo(Semestre::class, 'semestre_id');
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }
}