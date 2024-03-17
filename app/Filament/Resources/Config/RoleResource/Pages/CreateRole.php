<?php

namespace App\Filament\Resources\Config\RoleResource\Pages;

use App\Filament\Resources\Config\RoleResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;
    protected function handleRecordCreation(array $data): Model
    {
        $u = static::getModel()::create($data);
        $recipient = auth()->user();
        Notification::make()
            ->title('Roles data created successfully')
            ->body('Changes to the name=>'.ucfirst($data['name']).' data have been created.')
            ->sendToDatabase($recipient)
            ->broadcast($recipient);
        return $u;
    }
}
