<?php

namespace App\Filament\Resources\Config\RoleResource\Pages;

use App\Filament\Resources\Config\RoleResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;

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
            ->title('Roles data Saved successfully')
            ->body('Changes to the name=>'.ucfirst($data['name']).' data have been saved.')
            ->sendToDatabase($recipient)
            ->broadcast($recipient);
        return $record;
    }
}
