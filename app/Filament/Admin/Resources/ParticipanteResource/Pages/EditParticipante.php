<?php

namespace App\Filament\Admin\Resources\ParticipanteResource\Pages;

use App\Filament\Admin\Resources\ParticipanteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditParticipante extends EditRecord
{
    protected static string $resource = ParticipanteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
