<?php

namespace App\Filament\Resources\Project\ProjectResource\Pages;

use App\Filament\Resources\Project\ProjectResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);
        $recipient = auth()->user();
        Notification::make()
            ->title('Project data Saved successfully')
            ->body('Changes to the name=>'.ucfirst($data['name']).' data have been saved.')
            ->sendToDatabase($recipient)
            ->broadcast($recipient);
            return $record;
    }
}
