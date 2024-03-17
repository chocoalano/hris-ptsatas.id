<?php

namespace App\Filament\Resources\Config\PermissionResource\Pages;

use App\Filament\Resources\Config\PermissionResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreatePermission extends CreateRecord
{
    protected static string $resource = PermissionResource::class;
    protected function handleRecordCreation(array $data):Model
    {
        $record = static::getModel()::create($data);
        $recipient = auth()->user();
        Notification::make()
            ->title('Permissions data Created successfully')
            ->body('Added to the name=>'.ucfirst($data['name']).' and description=>'.ucfirst($data['description']).' data have been created.')
            ->sendToDatabase($recipient)
            ->broadcast($recipient);
        return $record;
    }
}
