<?php

namespace App\Filament\Resources\Sales;

use App\Filament\Resources\Sales\CustomerResource\Pages;
use App\Filament\Resources\Sales\CustomerResource\RelationManagers;
use App\Models\Sales\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Customers List';
    protected static ?string $navigationGroup = 'Project Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Roles Forms')->columns([ 'sm' => 1, 'xl' => 2, '2xl' => 2,])->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(20),
                    Forms\Components\Select::make('roles')
                        ->label('Give to permission')
                        ->multiple()
                        ->relationship(name: 'permission', titleAttribute: 'name')
                        ->required()
                        ->options(\App\Models\Config\Permission::all()->pluck('name', 'id'))
                        ->loadingMessage('Loading...'),
                    Forms\Components\Textarea::make('description')->columnSpan('full'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
