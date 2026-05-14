<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peso extends Model
{
    protected $fillable = [

        'semestre_id',

        'rendimiento',

        'comportamiento',

        'pagos',

        'referente'
    ];
}