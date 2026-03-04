<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ejercicio extends Model
{
    use HasFactory;

    protected $table = 'ejercicios';

    protected $fillable = [
        'tipo_ejercicio_id',
        'nombre',
        'fecha',
        'tiempo_objetivo_seg',
        'notas',
    ];

    protected $casts = [
        'fecha' => 'date',
        'tiempo_objetivo_seg' => 'integer',
    ];

    public function tipo(): BelongsTo
    {
        return $this->belongsTo(TipoEjercicio::class, 'tipo_ejercicio_id');
    }

    public function fases(): HasMany
    {
        return $this->hasMany(EjercicioFase::class, 'ejercicio_id');
    }

    public function ejercicioParticipantes(): HasMany
    {
        return $this->hasMany(EjercicioParticipante::class, 'ejercicio_id');
    }

}
