<?php

namespace App\Filament\Admin\Resources\KategoriKegiatanResource\Pages;

use App\Filament\Admin\Resources\KategoriKegiatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriKegiatans extends ListRecords
{
    protected static string $resource = KategoriKegiatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
