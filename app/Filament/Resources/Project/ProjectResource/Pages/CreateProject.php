<?php

namespace App\Filament\Resources\Project\ProjectResource\Pages;

use App\Filament\Resources\Project\ProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['createdby'] = auth()->id();
        return $data;
    }
}
