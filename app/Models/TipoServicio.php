<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoServicio extends Model
{
    protected $table = 'tipo_servicio';
    protected $primaryKey = 'id_tipo_servicio';
    
    protected $fillable = [
        'nombre_servicio',
        'hora_inicio',
        'hora_fin'
    ];
    
    protected $casts = [
        'hora_inicio' => 'datetime:H:i',
        'hora_fin' => 'datetime:H:i'
    ];
}