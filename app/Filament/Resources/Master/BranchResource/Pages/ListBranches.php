<?php

namespace App\Filament\Resources\Master\BranchResource\Pages;

use App\Filament\Resources\Master\BranchResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBranches extends ListRecords
{
    protected static string $resource = BranchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
