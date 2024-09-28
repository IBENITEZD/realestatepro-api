<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Tipo extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'tipos';

    protected $fillable = [
        'codigo',
        'descripcion'
    ];
}
