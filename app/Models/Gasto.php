<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Gasto extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'gastos';

    protected $fillable = [
        'id_inmueble',
        'importe',
        'concepto',
        'fecha_emision',
        'observaciones'
    ];
}

