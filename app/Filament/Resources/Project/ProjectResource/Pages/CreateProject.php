<?php

namespace App\Filament\Resources\Project\ProjectResource\Pages;

use App\Filament\Resources\Project\ProjectResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['createdby'] = auth()->id();
        return $data;
    }
    protected function handleRecordCreation(array $data): Model
    {
        $u = static::getModel()::create($data);
        $recipient = auth()->user();
        Notification::make()
            ->title('Project data created successfully')
            ->body('Changes to the name=>'.ucfirst($data['name']).' data have been created.')
            ->sendToDatabase($recipient)
            ->broadcast($recipient);
        return $u;
    }
}
