<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $fillable = [
        'dni',
        'nombre',
        'aspecto1',
        'aspecto2',
        'aspecto3',
        'aspecto4',
    ];
}
