<?php

namespace App\Filament\Admin\Resources\DonasiBarangResource\Pages;

use App\Filament\Admin\Resources\DonasiBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDonasiBarang extends EditRecord
{
    protected static string $resource = DonasiBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
