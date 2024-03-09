<?php

namespace App\Filament\Resources\Project\ProjectResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MembersRelationManager extends RelationManager
{
    protected static string $relationship = 'members';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('No.')->rowIndex(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('mobile_phone')->searchable(),
                Tables\Columns\TextColumn::make('phone')->searchable(),
                Tables\Columns\TextColumn::make('placebirth')->searchable(),
                Tables\Columns\TextColumn::make('birthdate')->searchable(),
                Tables\Columns\TextColumn::make('gender')->badge()
                ->color(fn (string $state): string => match ($state) {
                    'male' => 'primary',
                    'female' => 'success',
                })->searchable(),
                Tables\Columns\TextColumn::make('religion')->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
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
