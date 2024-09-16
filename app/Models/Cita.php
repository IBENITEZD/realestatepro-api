<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $fillable = [
        'id_inmueble',
        'nombre',
        'email',  
        'fecha_hora',
        'observaciones'
    ];
}
