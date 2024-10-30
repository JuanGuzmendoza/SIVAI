<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    protected $table = 'ambientes';
    protected $fillable = [
        'codigo',
        'nombre',
        'piso',
    ];
}
