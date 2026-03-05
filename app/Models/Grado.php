<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'orden',
    ];

    public function participantes()
    {
        return $this->hasMany(Participante::class);
    }
}
