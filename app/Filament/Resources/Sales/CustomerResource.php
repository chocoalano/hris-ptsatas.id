<?php

namespace App\Filament\Resources\Sales;

use App\Filament\Resources\Sales\CustomerResource\Pages;
use Illuminate\Support\Str;
use App\Models\Sales\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Customers List';
    protected static ?string $navigationIcon = 'fas-user-tie';
    protected static ?string $navigationGroup = 'Project Management';
    public static function getGloballySearchableAttributes(): array
    {
        return [ 'userCreated.name', 'fullname', 'address', 'company', 'type', 'phone', 'email'];
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Customers Forms')->columns([ 'sm' => 1, 'xl' => 2, '2xl' => 2,])->schema([
                    Forms\Components\TextInput::make('fullname')->required(),
                    Forms\Components\TextInput::make('company')->required(),
                    Forms\Components\TextInput::make('type')->required(),
                    Forms\Components\TextInput::make('phone')->numeric()->required(),
                    Forms\Components\Textarea::make('address')->columnSpan('full'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No.')->rowIndex(),
                Tables\Columns\TextColumn::make('fullname')->limit(50)->searchable()->description(fn (Customer $record): string => Str::limit($record->address, 50)),
                Tables\Columns\TextColumn::make('company')->searchable(),
                Tables\Columns\TextColumn::make('type')->searchable(),
                Tables\Columns\TextColumn::make('phone')->searchable(),
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
