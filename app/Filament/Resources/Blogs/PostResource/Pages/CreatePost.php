<?php

namespace App\Filament\Resources\Blogs\PostResource\Pages;

use App\Filament\Resources\Blogs\PostResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['createdby'] = auth()->id();
        $data['slug'] = Str::slug($data['title']);
        return $data;
    }
    protected function handleRecordCreation(array $data): Model
    {
        $u = static::getModel()::create($data);
        $recipient = auth()->user();
        Notification::make()
            ->title('Post blog task data created successfully')
            ->body('Created to the title=>'.ucfirst($data['title']).' data have been created.')
            ->sendToDatabase($recipient)
            ->broadcast($recipient);
        return $u;
    }
}
