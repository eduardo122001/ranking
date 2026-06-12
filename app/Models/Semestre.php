<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Semestre extends Model
{
    protected $fillable = [
        'nombre',
        'peso_id'
    ];

    /**
     * Obtener el peso asociado a este semestre.
     */
    public function peso(): BelongsTo
    {
        return $this->belongsTo(Peso::class, 'peso_id');
    }
}