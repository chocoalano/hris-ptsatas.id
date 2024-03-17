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
        $u = static::getModel()::create([
            'name'=>$data['name'],
            'role_id'=>$data['role_id'],
            'email'=>$data['email'],
            'email_verified_at'=>$data['email_verified_at'],
            'phone'=>$data['phone'],
            'password'=>$data['password'],
        ]);
        $recipient = auth()->user();
        Notification::make()
            ->title('Users data Saved successfully')
            ->body('Added to the name=>'.ucfirst($data['name']).' and email=>'.ucfirst($data['email']).' data have been created.')
            ->sendToDatabase($recipient)
            ->broadcast($recipient);
        return $u;
    }
}
