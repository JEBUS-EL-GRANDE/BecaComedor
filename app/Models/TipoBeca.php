<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoBeca extends Model
{
    protected $table = 'tipo_beca';
    protected $primaryKey = 'id_tipo';
    
    protected $fillable = [
        'tipo_beca',
        'duracion',
        'descripcion'
    ];
}