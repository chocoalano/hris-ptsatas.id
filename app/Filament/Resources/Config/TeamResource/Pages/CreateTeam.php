<?php

namespace App\Filament\Resources\Config\TeamResource\Pages;

use App\Filament\Resources\Config\TeamResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateTeam extends CreateRecord
{
    protected static string $resource = TeamResource::class;
    protected function handleRecordCreation(array $data): Model
    {
        $u = static::getModel()::create($data);
        $recipient = auth()->user();
        Notification::make()
            ->title('Teams data created successfully')
            ->body('Changes to the name=>'.ucfirst($data['name']).' data have been created.')
            ->sendToDatabase($recipient)
            ->broadcast($recipient);
        return $u;
    }
}
