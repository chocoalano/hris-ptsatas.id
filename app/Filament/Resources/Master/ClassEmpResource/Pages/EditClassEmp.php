<?php

namespace App\Filament\Resources\Master\ClassEmpResource\Pages;

use App\Filament\Resources\Master\ClassEmpResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClassEmp extends EditRecord
{
    protected static string $resource = ClassEmpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
