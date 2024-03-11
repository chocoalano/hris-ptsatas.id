<?php

namespace App\Filament\Resources\Config\UserResource\Pages;

use App\Filament\Resources\Config\UserResource;
use Filament\Actions;
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
            $u['mobile_phone']=$data['mobile_phone'];
            $u['phone']=$data['phone'];
            $u['placebirth']=$data['placebirth'];
            $u['birthdate']=$data['birthdate'];
            $u['gender']=$data['gender'];
            $u['bloodtype']=$data['bloodtype'];
            $u['religion']=$data['religion'];
            $u['identity_address']=$data['identity_address'];
            $u['identity_numbers']=$data['identity_numbers'];
            $u['identity_expired']=$data['identity_expired'];
            $u['postal_code']=$data['postal_code'];
            $u['citizen_idaddress']=$data['citizen_idaddress'];
            $u['recidential_address']=$data['recidential_address'];
            $u->save();
            $u->emp()->updateOrCreate(
                ['user_id' => $u->id],
                $data['emp']
            );
            $u->emergency_contact()->updateOrCreate(
                ['user_id' => $u->id],
                $data['ec']
            );
            if($u->family->count() > 0){
                $items_ids = $u->family->pluck('id');
                $u->family()->whereIn('id', $items_ids)->delete();
            }
            $u->family()->createMany($data['family']);
            if($u->education->count() > 0){
                $items_ids = $u->education->pluck('id');
                $u->education()->whereIn('id', $items_ids)->delete();
            }
            $u->education()->createMany($data['education']);
        }
        return $u;
    }
}
