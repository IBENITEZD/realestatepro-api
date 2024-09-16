<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tercero extends Model
{
    protected $fillable = [
        'doc_identidad',
        'nombre',
        'apellidos',
        'email',
        'direccion',
        'telefono_movil',        
        'telefono_fijo',  
        'id_ciudad'      
    ];
}

