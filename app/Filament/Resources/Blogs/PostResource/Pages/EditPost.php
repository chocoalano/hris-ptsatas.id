<?php

namespace App\Filament\Resources\Blogs\PostResource\Pages;

use App\Filament\Resources\Blogs\PostResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['createdby'] = auth()->id();
        $data['slug'] = Str::slug($data['title']);
        return $data;
    }
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);
        $recipient = auth()->user();
        Notification::make()
            ->title('Post blog task data updated successfully')
            ->body('Changed to the title=>'.ucfirst($data['title']).' data have been updated.')
            ->sendToDatabase($recipient)
            ->broadcast($recipient);
        return $record;
    }
}
