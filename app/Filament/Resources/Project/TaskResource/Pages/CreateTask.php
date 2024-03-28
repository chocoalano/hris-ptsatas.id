<?php

namespace App\Filament\Resources\Project\TaskResource\Pages;

use App\Filament\Resources\Project\TaskResource;
use App\Models\Project\ProjectManagement;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateTask extends CreateRecord
{
    protected static string $resource = TaskResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['createdby'] = auth()->id();
        return $data;
    }
    protected function handleRecordCreation(array $data): Model
    {
        $u = static::getModel()::create($data);
        $p = ProjectManagement::find($u->project_management_id);
        $recipient = auth()->user();
        Notification::make()
            ->title('Project task data created successfully')
            ->body('Data have been created.')
            ->sendToDatabase($recipient)
            ->broadcast($recipient);
        return $u;
    }
}
