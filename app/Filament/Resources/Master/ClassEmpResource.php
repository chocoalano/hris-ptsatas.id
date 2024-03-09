<?php

namespace App\Filament\Resources\Master;

use App\Filament\Resources\Master\ClassEmpResource\Pages;
use App\Filament\Resources\Master\ClassEmpResource\RelationManagers;
use App\Models\Master\ClassEmp;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClassEmpResource extends Resource
{
    protected static ?string $model = ClassEmp::class;

    protected static ?string $navigationLabel = 'Employe Classes';
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
            'index' => Pages\ListClassEmps::route('/'),
            'create' => Pages\CreateClassEmp::route('/create'),
            'edit' => Pages\EditClassEmp::route('/{record}/edit'),
        ];
    }
}
