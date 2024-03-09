<?php

namespace App\Filament\Resources\Project\TaskResource\Pages;

use App\Filament\Resources\Project\TaskResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTask extends CreateRecord
{
    protected static string $resource = TaskResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['createdby'] = auth()->id();
        return $data;
    }
}
