<?php

namespace Database\Seeders;

use App\Models\Grado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grados = [
            ['nombre' => 'Subteniente', 'orden' => 1],
            ['nombre' => 'Alférez de Fragata', 'orden' => 2],
            ['nombre' => 'Teniente', 'orden' => 3],
            ['nombre' => 'Alférez de Navío', 'orden' => 4],
            ['nombre' => 'Capitan Segundo', 'orden' => 5],
            ['nombre' => 'Teniente de Fragata', 'orden' => 6],
            ['nombre' => 'Capitan Primero', 'orden' => 7],
            ['nombre' => 'Teniente de Navío', 'orden' => 8],
            ['nombre' => 'Mayor', 'orden' => 9],
            ['nombre' => 'Capitán de Corbeta', 'orden' => 10],
            ['nombre' => 'Teniente Coronel', 'orden' => 11],
            ['nombre' => 'Capitán de Fragata', 'orden' => 12],
            ['nombre' => 'Coronel', 'orden' => 13],
            ['nombre' => 'Capitán de Navío', 'orden' => 14],
            ['nombre' => 'General de Brigada', 'orden' => 15],
            ['nombre' => 'Vicealmirante', 'orden' => 16],
            ['nombre' => 'General de División', 'orden' => 17],
            ['nombre' => 'Almirante', 'orden' => 18],
        ];

        foreach ($grados as $grado) {
            Grado::create($grado);
        }
    }
}
