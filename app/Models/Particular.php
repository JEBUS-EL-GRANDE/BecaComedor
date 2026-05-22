<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Particular extends Model
{
    protected $table = 'particular';
    // Según tu migración, el id_personal es la clave primaria de esta tabla (relación 1:1)
    protected $primaryKey = 'id_personal'; 
    protected $fillable = ['id_personal', 'tipo_particular'];
    public $timestamps = true;
    
    // Para indicarle a Eloquent que la clave primaria no es autoincremental
    public $incrementing = false; 
    protected $keyType = 'int'; // o 'string' si usas CHAR para id_personal

    /**
     * Relación uno a uno (inversa): Un particular es una persona.
     */
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_personal', 'id_personal');
    }
}