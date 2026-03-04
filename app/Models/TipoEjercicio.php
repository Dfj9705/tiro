<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoEjercicio extends Model
{
    use HasFactory;
    protected $table = 'tipos_ejercicio';

    protected $fillable = ['nombre', 'descripcion', 'activo'];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function ejercicios(): HasMany
    {
        return $this->hasMany(Ejercicio::class, 'tipo_ejercicio_id');
    }
}
