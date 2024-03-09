<?php

namespace App\Filament\Resources\Master\OrganizationResource\Pages;

use App\Filament\Resources\Master\OrganizationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrganizations extends ListRecords
{
    protected static string $resource = OrganizationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
