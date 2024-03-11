<?php

namespace App\Filament\Resources\Sales\CustomerResource\Pages;

use App\Filament\Resources\Sales\CustomerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;
}
