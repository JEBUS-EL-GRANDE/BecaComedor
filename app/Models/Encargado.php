<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encargado extends Model
{
    protected $table = 'encargado';
    protected $primaryKey = 'id_encargado'; // Según tu migración
    protected $fillable = ['cargo', 'turno', 'id_personal'];
    public $timestamps = true;

    /**
     * Relación uno a uno (inversa): Un encargado es una persona.
     */
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_personal', 'id_personal');
    }
}