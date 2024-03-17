<?php

namespace App\Filament\Resources\Config\TeamResource\Pages;

use App\Filament\Resources\Config\TeamResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditTeam extends EditRecord
{
    protected static string $resource = TeamResource::class;

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
            ->title('Teams data Saved successfully')
            ->body('Changes to the name=>'.ucfirst($data['name']).' data have been saved.')
            ->sendToDatabase($recipient)
            ->broadcast($recipient);
            return $record;
    }
}
