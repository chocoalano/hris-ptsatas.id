<?php

namespace App\Filament\Resources\Project;

use Illuminate\Support\Str;
use App\Filament\Resources\Project\TaskResource\Pages;
use App\Filament\Resources\Project\TaskResource\RelationManagers;
use App\Models\Project\ProjectTask;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TaskResource extends Resource
{
    protected static ?string $model = ProjectTask::class;

    protected static ?string $navigationLabel = 'Project Task';
    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';
    protected static ?string $navigationGroup = 'Project Management';

    public static function getGloballySearchableAttributes(): array
    {
        return ['progress', 'description'];
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Project Task Assignment')
                ->description('Add anyone who will contribute')
                ->columns([ 'sm' => 1, 'xl' => 3, '2xl' => 3,])->schema([
                    Forms\Components\Select::make('project_management_id')->relationship(name: 'project', titleAttribute: 'name')->options(\App\Models\Project\ProjectManagement::all()->pluck('name', 'id'))->required(),
                    Forms\Components\Select::make('assignto')->options(\App\Models\User::all()->pluck('name', 'id'))->required(),
                    Forms\Components\TextInput::make('progress')->numeric()->required(),
                    Forms\Components\DatePicker::make('start_date')->required(),
                    Forms\Components\DatePicker::make('due_date')->required(),
                    Forms\Components\RichEditor::make('description')->columnSpan('full')->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No.')->rowIndex(),
                Tables\Columns\TextColumn::make('project.name')->limit(50)->searchable(),
                Tables\Columns\TextColumn::make('createdByUser.name')->searchable(),
                Tables\Columns\TextColumn::make('asign.name')->searchable(),
                Tables\Columns\TextColumn::make('progress')->numeric(decimalPlaces: 0)->formatStateUsing(fn (string $state): string => __("{$state}%"))->searchable(),
            ])
            ->filters([
                //
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
            RelationManagers\ProjectRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'view' => Pages\ViewTask::route('/{record}'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
