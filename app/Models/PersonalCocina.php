<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalCocina extends Model
{
    protected $table = 'personal_cocina';
    protected $primaryKey = 'id_personal';
    
    protected $fillable = [
        'id_personal',
        'especialidad',
        'horario_trabajo'
    ];
    
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_personal', 'id_personal');
    }
}