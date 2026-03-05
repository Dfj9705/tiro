<?php

namespace App\Filament\Admin\Resources\EjercicioResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FasesRelationManager extends RelationManager
{
    protected static string $relationship = 'fases';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nombre')
                ->required()
                ->maxLength(120),

            Forms\Components\TextInput::make('orden')
                ->numeric()
                ->required()
                ->default(fn() => (($this->getOwnerRecord()->fases()->max('orden') ?? 0) + 1)),

            Forms\Components\TextInput::make('tiempo_objetivo_seg')
                ->label('Tiempo objetivo (seg)')
                ->numeric()
                ->nullable(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->defaultSort('orden')
            ->columns([
                Tables\Columns\TextColumn::make('orden')->sortable(),
                Tables\Columns\TextColumn::make('nombre')->searchable(),
                Tables\Columns\TextColumn::make('tiempo_objetivo_seg')->label('Tiempo (seg)')->sortable(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
