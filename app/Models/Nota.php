<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model  //modificar esto o eliminarlo, esto funcionaba con mi bd de prueba chiquita
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
