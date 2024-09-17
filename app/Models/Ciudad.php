<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Ciudad extends Model
{
    use HasFactory;
 
    protected $table = 'ciudades';

    protected $fillable = [
        'codigo',
        'nombre',
        'id_provincia'
    ];
}


