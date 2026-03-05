<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EjercicioResource\Pages;
use App\Filament\Admin\Resources\EjercicioResource\RelationManagers;
use App\Models\Ejercicio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EjercicioResource extends Resource
{
    protected static ?string $model = Ejercicio::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Control';
    protected static ?string $navigationLabel = 'Ejercicios';
    protected static ?string $modelLabel = 'Ejercicio';
    protected static ?string $pluralModelLabel = 'Ejercicios';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Datos del ejercicio')
                ->schema([
                    Forms\Components\Select::make('tipo_ejercicio_id')
                        ->label('Tipo')
                        ->relationship('tipo', 'nombre')
                        ->searchable()
                        ->preload()
                        ->required(),

                    Forms\Components\TextInput::make('nombre')
                        ->required()
                        ->maxLength(150),

                    Forms\Components\DatePicker::make('fecha')
                        ->required()
                        ->default(now()),

                    Forms\Components\TextInput::make('tiempo_objetivo_seg')
                        ->label('Tiempo objetivo (seg)')
                        ->numeric()
                        ->minValue(1)
                        ->nullable(),

                    Forms\Components\Textarea::make('notas')
                        ->rows(3)
                        ->nullable(),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('fecha', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('fecha')->date()->sortable(),
                Tables\Columns\TextColumn::make('nombre')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('tipo.nombre')->label('Tipo')->sortable(),
                Tables\Columns\TextColumn::make('tiempo_objetivo_seg')->label('Tiempo (seg)')->toggleable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\FasesRelationManager::class,
            RelationManagers\EjercicioParticipantesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEjercicios::route('/'),
            'create' => Pages\CreateEjercicio::route('/create'),
            'view' => Pages\ViewEjercicio::route('/{record}'),
            'edit' => Pages\EditEjercicio::route('/{record}/edit'),
        ];
    }
}
