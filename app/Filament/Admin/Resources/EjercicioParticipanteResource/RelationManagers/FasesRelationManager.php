<?php

namespace App\Filament\Admin\Resources\EjercicioParticipanteResource\RelationManagers;

use App\Models\EjercicioFase;
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

    protected static ?string $title = 'Resultados por fase';

    public function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Select::make('ejercicio_fase_id')
                ->label('Fase')
                ->required()
                ->searchable()
                ->options(function () {

                    $owner = $this->getOwnerRecord();

                    return EjercicioFase::query()
                        ->where('ejercicio_id', $owner->ejercicio_id)
                        ->orderBy('orden')
                        ->get()
                        ->mapWithKeys(fn($fase) => [
                            $fase->id => $fase->orden . '. ' . $fase->nombre
                        ])
                        ->toArray();
                }),

            Forms\Components\TextInput::make('c_5x')
                ->label('5x')
                ->numeric()
                ->default(0),

            Forms\Components\TextInput::make('c_5')
                ->label('5')
                ->numeric()
                ->default(0),

            Forms\Components\TextInput::make('c_4')
                ->label('4')
                ->numeric()
                ->default(0),

            Forms\Components\TextInput::make('c_3')
                ->label('3')
                ->numeric()
                ->default(0),

            Forms\Components\TextInput::make('c_2')
                ->label('2')
                ->numeric()
                ->default(0),

            Forms\Components\TextInput::make('c_1')
                ->label('1')
                ->numeric()
                ->default(0),

            Forms\Components\TextInput::make('tiempo_real_seg')
                ->label('Tiempo (seg)')
                ->numeric()
                ->nullable(),

        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('fase.nombre')
                    ->label('Fase'),

                Tables\Columns\TextColumn::make('c_5x')->label('5x'),
                Tables\Columns\TextColumn::make('c_5')->label('5'),
                Tables\Columns\TextColumn::make('c_4')->label('4'),
                Tables\Columns\TextColumn::make('c_3')->label('3'),
                Tables\Columns\TextColumn::make('c_2')->label('2'),
                Tables\Columns\TextColumn::make('c_1')->label('1'),

                Tables\Columns\TextColumn::make('tiempo_real_seg')
                    ->label('Tiempo'),

                Tables\Columns\TextColumn::make('subtotal_puntos')
                    ->label('Puntos'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Agregar fase'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }
}
