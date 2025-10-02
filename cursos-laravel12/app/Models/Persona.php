<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    /** @use HasFactory<\Database\Factories\PersonaFactory> */
    use HasFactory;

    protected $fillable = ['numero_documento','nombres','apellidos','sexo','fecha_nacimiento','celular'];

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }
}
