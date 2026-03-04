<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Participante extends Model
{
    use HasFactory;
    protected $table = 'participantes';

    protected $fillable = ['nombres', 'apellidos', 'alias', 'activo'];

    protected $casts = [
        'activo' => 'boolean',
    ];

    public function ejercicios(): BelongsToMany
    {
        return $this->belongsToMany(Ejercicio::class, 'ejercicio_participante')
            ->withPivot(['id', 'tiempo_real_seg', 'total_puntos', 'total_5x'])
            ->withTimestamps();
    }

    public function getNombreCompletoAttribute(): string
    {
        return trim(($this->nombres ?? '') . ' ' . ($this->apellidos ?? ''));
    }
}
