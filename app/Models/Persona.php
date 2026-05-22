<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Persona extends Authenticatable{
    use HasFactory;
    protected $table = 'personas';
    protected $primaryKey = 'id_personal';
    protected $casts = [
        'contrasena' => 'string', 
    ];

    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'email',
        'contrasena',
        'sexo',
        'ci',
        'direccion',
        'rol',
    ];
    protected $hidden = [
        'contrasena',
    ];
    /**eliminar espacios */
protected function rol(): Attribute{
    return Attribute::make(
        get: fn ($value) => trim($value),
    );
}
public function getAuthPassword(){
    return $this->contrasena;
}
public function particular()
    {
        return $this->hasOne(Particular::class, 'id_personal', 'id_personal');
    }
}