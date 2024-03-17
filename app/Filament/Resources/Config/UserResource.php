<?php

namespace App\Filament\Resources\Config;

use App\Filament\Resources\Config\UserResource\Pages;
use App\Filament\Resources\Config\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationLabel = 'Users Manage';
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Master Data';
    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'email', 'email_verified_at', 'phone'];
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Detail Users Data')->columns(['sm' => 3, 'xl' => 4, '2xl' => 4])->schema([
                Infolists\Components\TextEntry::make('name')->color('primary'),
                Infolists\Components\TextEntry::make('email')->color('primary'),
                Infolists\Components\TextEntry::make('email_verified_at')->color('primary'),
                Infolists\Components\TextEntry::make('phone')->color('primary'),
                ])
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Form Users')->columns([ 'sm' => 1, 'xl' => 3, '2xl' => 3,])->schema([
                    Forms\Components\TextInput::make('name')->required(),
                    Forms\Components\Select::make('role_id')->relationship(name: 'role', titleAttribute: 'name')->label('Role User')->options(\App\Models\Config\Role::all()->pluck('name', 'id'))->searchable()->required(),
                    Forms\Components\TextInput::make('email')->email()->required(),
                    Forms\Components\DatePicker::make('email_verified_at')->required(),
                    Forms\Components\TextInput::make('phone')->numeric()->required(),
                    Forms\Components\TextInput::make('password')->password(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No.')->rowIndex(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('phone')->searchable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
                Tables\Filters\SelectFilter::make('role')
                    ->relationship('role', 'name')
                    ->options(\App\Models\Config\Role::all()->pluck('name', 'id'))
                    ->searchable()
                    ->preload()
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            RelationManagers\RoleRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
