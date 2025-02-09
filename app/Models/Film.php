<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    // Nombre de la tabla (opcional si es 'films')
    protected $table = 'films';

    // Campos permitidos para la asignación masiva
    protected $fillable = [
        'name',
        'year',
        'genre',
        'country',
        'duration',
        'img_url',
    ];

    // Si no necesitas timestamps (created_at y updated_at)
    public $timestamps = false;
}
