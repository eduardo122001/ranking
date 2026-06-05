<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'autor_id',
        'accion_id',
        'entidad',
        'entidad_id',
        'descripcion'
    ];

    public function autor()
    {
        return $this->belongsTo(User::class, 'autor_id');
    }

    public function accion()
    {
        return $this->belongsTo(Accion::class);
    }
}