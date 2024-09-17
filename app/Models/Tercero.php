<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Tercero extends Model
{
    use HasFactory;

    protected $table = 'terceros';

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

