<?php

namespace App\Filament\Admin\Resources\EjercicioResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EjercicioParticipantesRelationManager extends RelationManager
{
    protected static string $relationship = 'ejercicioParticipantes';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('participante_id')
                    ->relationship('participante', 'nombres')
                    ->label('Participante')
                    ->searchable()
                    ->preload()
                    ->required()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('participantes')
            ->columns([
                Tables\Columns\TextColumn::make('participante.nombres')
                    ->label('Participante'),
                Tables\Columns\TextColumn::make('participante.alias')
                    ->label('Alias'),
                Tables\Columns\IconColumn::make('participante.activo')
                    ->boolean()
                    ->label('Activo'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\Action::make('resultados')
                    ->label('Resultados')
                    ->icon('heroicon-o-trophy')
                    ->color('primary')
                    ->url(
                        fn($record) =>
                        \App\Filament\Admin\Resources\EjercicioParticipanteResource::getUrl(
                            'edit',
                            ['record' => $record]
                        )
                    ),

                Tables\Actions\EditAction::make(),

                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
