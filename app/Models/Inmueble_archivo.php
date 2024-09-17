<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Inmueble_archivo extends Model
{
    use HasFactory;

    protected $table = 'inmueble_archivos';

    protected $fillable = [
        'id_inmueble',
        'archivo',
        'tipo'
    ];
}
