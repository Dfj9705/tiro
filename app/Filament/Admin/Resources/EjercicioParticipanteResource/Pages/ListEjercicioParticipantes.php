<?php

namespace App\Filament\Admin\Resources\EjercicioParticipanteResource\Pages;

use App\Filament\Admin\Resources\EjercicioParticipanteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEjercicioParticipantes extends ListRecords
{
    protected static string $resource = EjercicioParticipanteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
