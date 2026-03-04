<?php

namespace App\Filament\Admin\Resources\ParticipanteResource\Pages;

use App\Filament\Admin\Resources\ParticipanteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListParticipantes extends ListRecords
{
    protected static string $resource = ParticipanteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
