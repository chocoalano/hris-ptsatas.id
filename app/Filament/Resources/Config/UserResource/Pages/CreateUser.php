<?php

namespace App\Filament\Resources\Config\UserResource\Pages;

use App\Filament\Resources\Config\UserResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    protected function handleRecordCreation(array $data): Model
    {
        if (!is_null($data['password']) || !is_null($data['email_verified_at'])) {
            $data['password'] = bcrypt($data['password']);
            $data['email_verified_at'] = $data['email_verified_at'] ?? null;
        }
        $u = static::getModel()::create($data);
        $recipient = auth()->user();
        Notification::make()
            ->title('Users data Saved successfully')
            ->body('Added to the name=>'.ucfirst($data['name']).' and email=>'.ucfirst($data['email']).' data have been created.')
            ->sendToDatabase($recipient)
            ->broadcast($recipient);
        return $u;
    }
}
