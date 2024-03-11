<?php

namespace App\Filament\Widgets;

use Illuminate\Support\Str;
use App\Filament\Resources\Project\TaskResource;
use App\Models\Project\ProjectTask;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\HtmlString;

class TaskOrders extends BaseWidget
{
    protected static ?int $sort=4;
    protected int | string | array $columnSpan = 'full';
    public function table(Table $table): Table
    {
        return $table
            ->query(TaskResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at')
            ->columns([
                Tables\Columns\TextColumn::make('No.')->rowIndex(),
                Tables\Columns\TextColumn::make('project.name')->limit(50)->searchable()->description(fn (ProjectTask $record): HtmlString => new HtmlString(Str::limit($record->description, 50))),
                Tables\Columns\TextColumn::make('createdByUser.name')->searchable(),
                Tables\Columns\TextColumn::make('asign.name')->searchable(),
                Tables\Columns\TextColumn::make('progress')->numeric(decimalPlaces: 0)->formatStateUsing(fn (string $state): string => __("{$state}%"))->searchable(),
            ]);
    }
}
