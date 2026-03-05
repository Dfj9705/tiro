<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ParticipanteResource\Pages;
use App\Filament\Admin\Resources\ParticipanteResource\RelationManagers;
use App\Models\Participante;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ParticipanteResource extends Resource
{
    protected static ?string $model = Participante::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Catálogos';
    protected static ?string $navigationLabel = 'Participantes';
    protected static ?string $modelLabel = 'Participante';
    protected static ?string $pluralModelLabel = 'Participantes';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('nombres')
                        ->required()
                        ->maxLength(120),

                    Forms\Components\TextInput::make('apellidos')
                        ->maxLength(120)
                        ->nullable(),

                    Forms\Components\TextInput::make('alias')
                        ->maxLength(80)
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
                Tables\Columns\TextColumn::make('nombre_completo')
                    ->label('Nombre')
                    ->searchable(query: function ($query, string $search) {
                        $query->where('nombres', 'like', "%{$search}%")
                            ->orWhere('apellidos', 'like', "%{$search}%")
                            ->orWhere('alias', 'like', "%{$search}%");
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('alias')->toggleable(),
                Tables\Columns\IconColumn::make('activo')->boolean()->sortable(),
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
            'index' => Pages\ListParticipantes::route('/'),
            'create' => Pages\CreateParticipante::route('/create'),
            'edit' => Pages\EditParticipante::route('/{record}/edit'),
        ];
    }
}
