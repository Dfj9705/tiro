<?php

namespace App\Filament\Admin\Resources\TipoEjercicioResource\Pages;

use App\Filament\Admin\Resources\TipoEjercicioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTipoEjercicios extends ListRecords
{
    protected static string $resource = TipoEjercicioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
