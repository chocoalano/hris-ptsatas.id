<?php

namespace App\Filament\Resources\Project;

use App\Filament\Resources\Project\ProjectResource\Pages;
use App\Filament\Resources\Project\ProjectResource\RelationManagers;
use Illuminate\Support\Str;
use App\Models\Project\ProjectManagement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;

class ProjectResource extends Resource
{
    protected static ?string $model = ProjectManagement::class;

    protected static ?string $navigationLabel = 'Project List';
    protected static ?string $navigationGroup = 'Project Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detail Project Created')->description('Make project details complete and clear!')
                ->columns([
                    'sm' => 3,
                    'xl' => 4,
                    '2xl' => 4,
                ])->schema([
                    TextInput::make('name')->columnSpan(4)->required(),
                    RichEditor::make('overview')->toolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ])->columnSpan(4)->required(),
                    TextInput::make('budget')->numeric()->required(),
                    DatePicker::make('start_date')->required(),
                    DatePicker::make('due_date')->required(),
                    TextInput::make('progress')->numeric()->required(),
                ]),
                Section::make('Member contributors')->description('Add anyone who will contribute')->schema([
                    Select::make('technologies')->relationship(name: 'members', titleAttribute: 'name')->multiple()->options(\App\Models\User::all()->pluck('name', 'id'))->required()
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No.')->rowIndex(),
                Tables\Columns\TextColumn::make('name')->limit(50)->searchable()->description(fn (ProjectManagement $record): string => Str::limit($record->overview, 50)),
                Tables\Columns\TextColumn::make('budget')->money('IDR')->searchable(),
                Tables\Columns\TextColumn::make('start_date')->searchable(),
                Tables\Columns\TextColumn::make('due_date')->searchable(),
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
            RelationManagers\MembersRelationManager::class,
            RelationManagers\TaskRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'view' => Pages\ViewProject::route('/{record}'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
