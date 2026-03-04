<?php

namespace App\Filament\Admin\Resources\EjercicioParticipanteResource\Pages;

use App\Filament\Admin\Resources\EjercicioParticipanteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEjercicioParticipante extends EditRecord
{
    protected static string $resource = EjercicioParticipanteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
