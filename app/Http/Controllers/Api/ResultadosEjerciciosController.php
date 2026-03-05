<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ejercicio;
use Illuminate\Http\Request;

class ResultadosEjerciciosController extends Controller
{
    public function index()
    {
        $ejercicios = Ejercicio::query()
            ->with('tipo:id,nombre')
            ->orderByDesc('fecha')
            ->get(['id', 'tipo_ejercicio_id', 'nombre', 'fecha', 'tiempo_objetivo_seg']);

        return response()->json([
            'data' => $ejercicios,
        ]);
    }

    public function show(Ejercicio $ejercicio)
    {
        $ejercicio->load([
            'tipo:id,nombre',
            'fases:id,ejercicio_id,nombre,orden,tiempo_objetivo_seg',
            'ejercicioParticipantes.participante:id,nombres,apellidos,alias',
        ]);

        // Ranking: si hay factor úsalo, si no puntos
        $ranking = $ejercicio->ejercicioParticipantes
            ->sortByDesc(fn($r) => $r->factor > 0 ? $r->factor : $r->total_puntos)
            ->sortByDesc('total_5x')      // desempate 5x
            ->sortByDesc('total_puntos')  // desempate puntos
            ->values()
            ->map(function ($r) {
                return [
                    'id' => $r->id,
                    'participante' => [
                        'id' => $r->participante->id,
                        'nombre' => trim($r->participante->grado?->nombre . ' ' . $r->participante->nombres . ' ' . $r->participante->apellidos),
                        'alias' => $r->participante->alias,
                    ],
                    'total_puntos' => (int) $r->total_puntos,
                    'total_5x' => (int) $r->total_5x,
                    'tiempo_seg' => $r->tiempo_real_seg,
                    'factor' => (float) $r->factor,
                ];
            });

        return response()->json([
            'data' => [
                'id' => $ejercicio->id,
                'nombre' => $ejercicio->nombre,
                'fecha' => $ejercicio->fecha->format('Y-m-d'),
                'tipo' => $ejercicio->tipo?->nombre,
                'tiempo_objetivo_seg' => $ejercicio->tiempo_objetivo_seg,
                'fases' => $ejercicio->fases->map(fn($f) => [
                    'id' => $f->id,
                    'orden' => (int) $f->orden,
                    'nombre' => $f->nombre,
                    'tiempo_objetivo_seg' => $f->tiempo_objetivo_seg,
                ]),
                'ranking' => $ranking,
            ],
        ]);
    }
}