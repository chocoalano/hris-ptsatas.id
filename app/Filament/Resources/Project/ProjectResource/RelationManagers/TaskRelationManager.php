<?php

namespace App\Filament\Resources\Project\ProjectResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskRelationManager extends RelationManager
{
    protected static string $relationship = 'task';

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
                Tables\Columns\TextColumn::make('project.name')->limit(50)->searchable(),
                Tables\Columns\TextColumn::make('createdByUser.name')->searchable()->limit(50),
                Tables\Columns\TextColumn::make('asign.name')->searchable(),
                Tables\Columns\TextColumn::make('progress')->numeric(decimalPlaces: 0)->formatStateUsing(fn (string $state): string => __("{$state}%"))->searchable(),
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
