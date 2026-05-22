<?php
// app/Models/Estudiante.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona;
use App\Models\Carrera;

class Estudiante extends Model
{
    protected $table = 'estudiante';
    protected $primaryKey = 'id_registro'; 
    protected $fillable = ['promedio_academico', 'situacion_academica', 'id_personal', 'id_carrera'];
    public $timestamps = false; 

    // Relaciones
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_personal', 'id_personal');
    }
    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'id_carrera', 'id_carrera');
    }
}