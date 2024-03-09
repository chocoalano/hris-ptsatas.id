<?php

namespace App\Filament\Resources\Master\JobPositionResource\Pages;

use App\Filament\Resources\Master\JobPositionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJobPosition extends EditRecord
{
    protected static string $resource = JobPositionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
