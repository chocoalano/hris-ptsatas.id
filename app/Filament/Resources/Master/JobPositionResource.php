<?php

namespace App\Filament\Resources\Master;

use App\Filament\Resources\Master\JobPositionResource\Pages;
use App\Filament\Resources\Master\JobPositionResource\RelationManagers;
use App\Models\Master\JobPosition;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JobPositionResource extends Resource
{
    protected static ?string $model = JobPosition::class;

    protected static ?string $navigationLabel = 'Job Position Manage';
    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Company Setup')
                ->description('The data added here will be displayed on several forms')
                ->schema([
                    Forms\Components\TextInput::make('name'),
                    Forms\Components\Textarea::make('description')->columnSpan(2),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No.')->rowIndex(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('description')->searchable()->limit(50),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListJobPositions::route('/'),
            'create' => Pages\CreateJobPosition::route('/create'),
            'edit' => Pages\EditJobPosition::route('/{record}/edit'),
        ];
    }
}
