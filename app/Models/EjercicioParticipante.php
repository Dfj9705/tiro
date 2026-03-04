<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EjercicioParticipante extends Model
{
    use HasFactory;

    protected $table = 'ejercicio_participante';

    protected $fillable = [
        'ejercicio_id',
        'participante_id',
        'tiempo_real_seg',
        'total_puntos',
        'total_5x',
    ];

    protected $casts = [
        'tiempo_real_seg' => 'integer',
        'total_puntos' => 'integer',
        'total_5x' => 'integer',
    ];

    public function ejercicio(): BelongsTo
    {
        return $this->belongsTo(Ejercicio::class, 'ejercicio_id');
    }

    public function participante(): BelongsTo
    {
        return $this->belongsTo(Participante::class, 'participante_id');
    }

    public function fases(): HasMany
    {
        return $this->hasMany(EjercicioParticipanteFase::class, 'ejercicio_participante_id');
    }
}
