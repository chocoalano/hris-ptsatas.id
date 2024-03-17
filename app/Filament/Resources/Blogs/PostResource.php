<?php

namespace App\Filament\Resources\Blogs;

use App\Filament\Resources\Blogs\PostResource\Pages;
use App\Filament\Resources\Blogs\PostResource\RelationManagers;
use App\Models\Blogs\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationLabel = 'Posts';
    protected static ?string $navigationIcon = 'fas-blog';
    protected static ?string $navigationGroup = 'Blogs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make([
                    'default' => 1,
                ])->schema([
                    Forms\Components\Split::make([
                        Forms\Components\Section::make([
                            Forms\Components\FileUpload::make('cover_image')
                                ->required()
                                ->columnSpanFull(),
                            Forms\Components\RichEditor::make('content')
                                ->required()
                                ->columnSpanFull(),
                        ]),
                        Forms\Components\Section::make([
                            Forms\Components\Select::make('category_id')
                                ->relationship(name: 'category', titleAttribute: 'name')
                                ->label('Category')
                                ->createOptionForm([
                                    Forms\Components\TextInput::make('name')
                                        ->required(),
                                ]),
                            Forms\Components\TextInput::make('title')
                                ->required()
                                ->maxLength(100),
                            Forms\Components\TextInput::make('keywords')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\TagsInput::make('tags')
                                    ->required(),
                            Forms\Components\Textarea::make('description')
                                ->required()
                                ->columnSpanFull(),
                        ])->grow(false),
                    ])->from('md')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->limit(50)
                    ->searchable(),
                Tables\Columns\TextColumn::make('keywords')
                    ->limit(50)
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('tags')
                    ->limit(50)
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
