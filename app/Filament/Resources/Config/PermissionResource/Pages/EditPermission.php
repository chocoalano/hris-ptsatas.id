<?php

namespace App\Filament\Resources\Config\PermissionResource\Pages;

use App\Filament\Resources\Config\PermissionResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditPermission extends EditRecord
{
    protected static string $resource = PermissionResource::class;

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
            ->title('Permissions data Saved successfully')
            ->body('Changes to the name=>'.ucfirst($data['name']).' and description=>'.ucfirst($data['description']).' data have been saved.')
            ->sendToDatabase($recipient)
            ->broadcast($recipient);
        return $record;
    }
}
