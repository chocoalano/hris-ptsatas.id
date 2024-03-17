<?php

namespace App\Filament\Resources\Config\UserResource\Pages;

use App\Filament\Resources\Config\UserResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
 
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $u = \App\Models\User::findOrFail($record->id);
        if($u){
            $u['name']=$data['name'];
            $u['email']=$data['email'];
            $u['email_verified_at']=$data['email_verified_at'];
            if($data['password']){
                $u['password']=$data['password'];
            }
            $u['phone']=$data['phone'];
            $u->save();
        }
        $recipient = auth()->user();
        Notification::make()
            ->title('Users data Saved successfully')
            ->body('Changes to the name=>'.ucfirst($data['name']).' and email=>'.ucfirst($data['email']).' data have been saved.')
            ->sendToDatabase($recipient)
            ->broadcast($recipient);
        return $u;
    }
}
