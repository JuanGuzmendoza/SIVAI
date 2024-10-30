<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'inventarios';

    protected $fillable = [
        'R',
        'centro',
        'modelo',
        'consec',
        'desc',
        'descripcion_actual',
        'tipo',
        'mod',
        'placa',
        'atributos',
        'fecha_adquisicion',
        'valor_ingreso',
        'ambiente_id',
        'profesor_id',
    ];


    public function ambiente()
    {
        return $this->belongsTo(Ambiente::class);
    }

    public function profesor()
    {
        return $this->belongsTo(Profesores::class);
    }
}
