<?php

namespace App\Filament\Admin\Resources\TipoEjercicioResource\Pages;

use App\Filament\Admin\Resources\TipoEjercicioResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTipoEjercicio extends EditRecord
{
    protected static string $resource = TipoEjercicioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
