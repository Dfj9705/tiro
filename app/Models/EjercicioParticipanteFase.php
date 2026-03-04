<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EjercicioParticipanteFase extends Model
{
    use HasFactory;

    protected $table = 'ejercicio_participante_fase';

    protected $fillable = [
        'ejercicio_participante_id',
        'ejercicio_fase_id',
        'c_5x',
        'c_5',
        'c_4',
        'c_3',
        'c_2',
        'c_1',
        'tiempo_real_seg',
        'subtotal_puntos',
        'subtotal_5x',
    ];

    protected $casts = [
        'c_5x' => 'integer',
        'c_5' => 'integer',
        'c_4' => 'integer',
        'c_3' => 'integer',
        'c_2' => 'integer',
        'c_1' => 'integer',
        'tiempo_real_seg' => 'integer',
        'subtotal_puntos' => 'integer',
        'subtotal_5x' => 'integer',
    ];

    public function ejercicioParticipante(): BelongsTo
    {
        return $this->belongsTo(EjercicioParticipante::class, 'ejercicio_participante_id');
    }

    public function fase(): BelongsTo
    {
        return $this->belongsTo(EjercicioFase::class, 'ejercicio_fase_id');
    }
}
