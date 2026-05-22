<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $table = 'administrador';
    protected $primaryKey = 'id_administrador';
    
    // id_personal es la FK/relación, pero no la PK de esta tabla, según tu esquema SQL
    protected $fillable = [
        'id_personal', 
        'ultimo_acceso', 
        'fecha_inicio_rol'
    ]; 
    
    public $timestamps = false; // No usamos created_at/updated_at según tu esquema SQL
    protected $dates = ['ultimo_acceso', 'fecha_inicio_rol']; // Para manejo automático de fechas

    /**
     * Relación uno a uno (inversa): Un administrador es una persona.
     */
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_personal', 'id_personal');
    }
}