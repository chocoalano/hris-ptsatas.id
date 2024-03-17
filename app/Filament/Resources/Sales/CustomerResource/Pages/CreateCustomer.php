<?php

namespace App\Filament\Resources\Sales\CustomerResource\Pages;

use App\Filament\Resources\Sales\CustomerResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['createdby'] = auth()->id();
        return $data;
    }
    protected function handleRecordCreation(array $data): Model
    {
        $u = static::getModel()::create($data);
        $recipient = auth()->user();
        Notification::make()
            ->title('Customers data created successfully')
            ->body('Created to the name=>'.ucfirst($data['name']).' data have been created.')
            ->sendToDatabase($recipient)
            ->broadcast($recipient);
        return $u;
    }
}
