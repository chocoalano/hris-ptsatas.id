<?php

namespace App\Filament\Resources\Blogs\PostCategoryResource\Pages;

use App\Filament\Resources\Blogs\PostCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePostCategory extends CreateRecord
{
    protected static string $resource = PostCategoryResource::class;
}
