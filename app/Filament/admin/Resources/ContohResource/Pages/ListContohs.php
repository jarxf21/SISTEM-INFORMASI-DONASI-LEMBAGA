<?php

namespace App\Filament\Admin\Resources\ContohResource\Pages;

use App\Filament\Admin\Resources\ContohResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContohs extends ListRecords
{
    protected static string $resource = ContohResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
