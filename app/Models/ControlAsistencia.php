<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ControlAsistencia extends Model
{
    protected $table = 'control_asistencia';
    protected $primaryKey = 'id_asistencia';
    
    protected $fillable = [
        'tipo_servicio',
        'observacion',
        'fecha',
        'id_estudiante'
    ];
    
    protected $casts = [
        'fecha' => 'date'
    ];
    
    // Relación con Estudiante
    public function estudiante(): BelongsTo
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante', 'id_registro');
    }
}