<?php

namespace App\Filament\Admin\Resources\DonasiBarangResource\Pages;

use App\Filament\Admin\Resources\DonasiBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDonasiBarangs extends ListRecords
{
    protected static string $resource = DonasiBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
