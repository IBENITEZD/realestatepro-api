<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;



class Inmueble extends Model
{

    use HasFactory;

    protected $table = 'inmuebles';

    protected $fillable = [
        'id_propietario',
        'descripcion',
        'area_m2',
        'num_banios',
        'num_habitaciones',
        'observaciones',        
        'direccion',  
        'imagen',  
        'disponibilidad',
        'amueblado',
        'nuevo_usado',        
        'compra_arriendo',  
        'valor',    
        'id_tipo',
        'id_ciudad'
    ];
}
