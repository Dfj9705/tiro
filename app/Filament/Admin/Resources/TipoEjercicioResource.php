<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TipoEjercicioResource\Pages;
use App\Filament\Admin\Resources\TipoEjercicioResource\RelationManagers;
use App\Models\TipoEjercicio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TipoEjercicioResource extends Resource
{
    protected static ?string $model = TipoEjercicio::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'Catálogos';
    protected static ?string $navigationLabel = 'Tipos de ejercicio';
    protected static ?string $modelLabel = 'Tipo de ejercicio';
    protected static ?string $pluralModelLabel = 'Tipos de ejercicio';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('nombre')
                        ->required()
                        ->maxLength(120),

                    Forms\Components\Textarea::make('descripcion')
                        ->rows(3)
                        ->nullable(),

                    Forms\Components\Toggle::make('activo')
                        ->default(true),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')->searchable()->sortable(),
                Tables\Columns\IconColumn::make('activo')->boolean()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime('Y-m-d H:i')->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('activo')->label('Activo'),
            ])
            ->actions([
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTipoEjercicios::route('/'),
            'create' => Pages\CreateTipoEjercicio::route('/create'),
            'edit' => Pages\EditTipoEjercicio::route('/{record}/edit'),
        ];
    }
}
