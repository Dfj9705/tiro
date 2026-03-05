<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EjercicioParticipanteResource\Pages;
use App\Filament\Admin\Resources\EjercicioParticipanteResource\RelationManagers;
use App\Models\EjercicioParticipante;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EjercicioParticipanteResource extends Resource
{
    protected static ?string $model = EjercicioParticipante::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Control';
    protected static ?string $modelLabel = 'Participante';
    protected static ?string $pluralModelLabel = 'Participantes';


    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Resumen')
                ->schema([
                    Forms\Components\Placeholder::make('ejercicio')
                        ->content(fn($record) => $record?->ejercicio?->nombre ?? '-'),

                    Forms\Components\Placeholder::make('participante')
                        ->content(fn($record) => $record?->participante?->nombre_completo ?? '-'),

                    Forms\Components\TextInput::make('tiempo_real_seg')
                        ->label('Tiempo (seg)')
                        ->numeric()
                        ->minValue(1)
                        ->nullable(),

                    Forms\Components\TextInput::make('total_puntos')
                        ->label('Total puntos')
                        ->numeric()
                        ->disabled()
                        ->dehydrated(false),

                    Forms\Components\TextInput::make('total_5x')
                        ->label('Total 5x')
                        ->numeric()
                        ->disabled()
                        ->dehydrated(false),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('ejercicio.nombre')->label('Ejercicio')->searchable(),
            Tables\Columns\TextColumn::make('participante.nombre_completo')->label('Participante')->searchable(),
            Tables\Columns\TextColumn::make('total_puntos')->label('Puntos')->sortable(),
        ])->actions([
                    Tables\Actions\EditAction::make(),
                ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\FasesRelationManager::class, // el RM que ya generaste para resultados por fase
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEjercicioParticipantes::route('/'),
            'create' => Pages\CreateEjercicioParticipante::route('/create'),
            'edit' => Pages\EditEjercicioParticipante::route('/{record}/edit'),
        ];
    }
}
