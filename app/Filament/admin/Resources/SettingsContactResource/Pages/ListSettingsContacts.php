<?php

namespace App\Filament\Admin\Resources\SettingsContactResource\Pages;

use App\Filament\Admin\Resources\SettingsContactResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSettingsContacts extends ListRecords
{
    protected static string $resource = SettingsContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
