<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Pais extends Model
{
    
    use HasFactory;

    protected $table = 'paises';

    protected $fillable = [
        'codigo',
        'nombre'
    ];
}

