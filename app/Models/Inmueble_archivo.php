<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inmueble_archivo extends Model
{
    protected $fillable = [
        'id_inmueble',
        'archivo',
        'tipo'
    ];
}