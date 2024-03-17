<?php

namespace App\Filament\Resources\Sales\CustomerResource\Pages;

use App\Filament\Resources\Sales\CustomerResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditCustomer extends EditRecord
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);
        $recipient = auth()->user();
        Notification::make()
            ->title('Customers data Saved successfully')
            ->body('Created to the name=>'.ucfirst($data['name']).' data have been saved.')
            ->sendToDatabase($recipient)
            ->broadcast($recipient);
            return $record;
    }
}
