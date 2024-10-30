<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserXProfesores extends Model
{
    protected $table='UserXProfesores';
    protected $fillable = [
        'user_id',
        'profesor_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function profesor()
    {
        return $this->belongsTo(Profesores::class);
    }

}
