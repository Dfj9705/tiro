<?php

namespace App\Filament\Admin\Resources\EjercicioResource\Pages;

use App\Filament\Admin\Resources\EjercicioResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEjercicio extends EditRecord
{
    protected static string $resource = EjercicioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
