<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Recibo extends Model
{
    use HasFactory;

    protected $table = 'recibos';

    protected $fillable = [
        'id_inmueble',
        'importe',
        'concepto',
        'fecha_emision',
        'via_pago',
        'observaciones'
    ];
}
