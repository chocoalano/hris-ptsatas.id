<?php

namespace App\Filament\Resources\Master;

use App\Filament\Resources\Master\BranchResource\Pages;
use App\Filament\Resources\Master\BranchResource\RelationManagers;
use App\Models\Master\Branch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Section;

class BranchResource extends Resource
{
    protected static ?string $model = Branch::class;

    protected static ?string $navigationLabel = 'Branch Manage';
    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Branch Company Setup')
                ->description('The data added here will be displayed on several forms')->columns([ 'sm' => 1, 'xl' => 2, '2xl' => 2,])->schema([
                    Forms\Components\Select::make('company_id')->relationship(name: 'company', titleAttribute: 'name')->label('Select Company Setup')->options(\App\Models\Master\Company::all()->pluck('name', 'id')),
                    Forms\Components\TextInput::make('name'),
                    Forms\Components\Textarea::make('address')->columnSpan('full'),
                    Forms\Components\TextInput::make('latitude'),
                    Forms\Components\TextInput::make('longitude'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No.')->rowIndex(),
                Tables\Columns\TextColumn::make('company.name')->searchable(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('address')->searchable()->limit(50),
                Tables\Columns\TextColumn::make('latitude')->searchable(),
                Tables\Columns\TextColumn::make('longitude')->searchable(),
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
            'index' => Pages\ListBranches::route('/'),
            'create' => Pages\CreateBranch::route('/create'),
            'edit' => Pages\EditBranch::route('/{record}/edit'),
        ];
    }
}
