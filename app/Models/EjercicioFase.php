<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EjercicioFase extends Model
{
    use HasFactory;

    protected $table = 'ejercicio_fases';

    protected $fillable = [
        'ejercicio_id',
        'nombre',
        'orden',
        'tiempo_objetivo_seg',
    ];

    protected $casts = [
        'orden' => 'integer',
        'tiempo_objetivo_seg' => 'integer',
    ];

    public function ejercicio(): BelongsTo
    {
        return $this->belongsTo(Ejercicio::class, 'ejercicio_id');
    }

    public function resultados(): HasMany
    {
        return $this->hasMany(EjercicioParticipanteFase::class, 'ejercicio_fase_id');
    }
}
