<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    // Las propiedades y métodos deben ir DENTRO de la clase
    protected $table = 'carrera';
    protected $primaryKey = 'id_carrera';
    protected $fillable = ['nombre_carrera'];
    public $timestamps = true; // Agregado para claridad
    
    // Si usas relaciones, irían aquí (ej: hasMany estudiantes)
    // public function estudiantes()
    // {
    //     return $this->hasMany(Estudiante::class, 'id_carrera', 'id_carrera');
    // }
}