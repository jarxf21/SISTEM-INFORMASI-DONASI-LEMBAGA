<?php

namespace App\Filament\Admin\Resources\DonasiResource\Pages;

use App\Filament\Admin\Resources\DonasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDonasis extends ListRecords
{
    protected static string $resource = DonasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
