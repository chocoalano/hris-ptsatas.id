<?php

namespace App\Filament\Resources\Master\ClassEmpResource\Pages;

use App\Filament\Resources\Master\ClassEmpResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClassEmps extends ListRecords
{
    protected static string $resource = ClassEmpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
