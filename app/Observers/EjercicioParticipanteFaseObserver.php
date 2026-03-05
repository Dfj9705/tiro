<?php

namespace App\Observers;

use App\Models\EjercicioParticipanteFase;

class EjercicioParticipanteFaseObserver
{
    public function saving(EjercicioParticipanteFase $model): void
    {
        $c5x = (int) ($model->c_5x ?? 0);
        $c5 = (int) ($model->c_5 ?? 0);
        $c4 = (int) ($model->c_4 ?? 0);
        $c3 = (int) ($model->c_3 ?? 0);
        $c2 = (int) ($model->c_2 ?? 0);
        $c1 = (int) ($model->c_1 ?? 0);

        $model->subtotal_5x = $c5x;

        // 5x vale 5 puntos pero se contabiliza aparte como “importancia”
        $model->subtotal_puntos = ($c5x * 5) + ($c5 * 5) + ($c4 * 4) + ($c3 * 3) + ($c2 * 2) + ($c1 * 1);
    }

    public function saved(EjercicioParticipanteFase $model): void
    {
        $this->recalcularTotales($model);
    }

    public function deleted(EjercicioParticipanteFase $model): void
    {
        $this->recalcularTotales($model);
    }

    private function recalcularTotales(EjercicioParticipanteFase $model): void
    {
        $ep = $model->ejercicioParticipante()->first();
        if (!$ep)
            return;

        $totalPuntos = (int) $ep->fases()->sum('subtotal_puntos');
        $total5x = (int) $ep->fases()->sum('subtotal_5x');

        // Tiempo: prioridad a tiempo por ejercicio; si no, sumar tiempos por fase
        $tiempoEjercicio = $ep->tiempo_real_seg;
        $tiempoFases = (int) $ep->fases()
            ->whereNotNull('tiempo_real_seg')
            ->sum('tiempo_real_seg');

        $tiempo = $tiempoEjercicio ?: ($tiempoFases ?: null);

        $factor = 0;
        if ($tiempo && $tiempo > 0) {
            $factor = $totalPuntos / $tiempo; // regla dada
        }

        $ep->update([
            'total_puntos' => $totalPuntos,
            'total_5x' => $total5x,
            'factor' => $factor,
        ]);
    }
}
