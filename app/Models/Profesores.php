<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesores extends Model
{
    protected $table = 'profesores';

    protected $fillable = [
        'nombre_profesor',
        'documento',
        'email_profesor',
        'telefono_profesor',
    ];
}
