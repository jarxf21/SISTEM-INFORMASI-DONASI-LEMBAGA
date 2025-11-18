<?php

namespace App\Filament\Admin\Resources\SettingsContactResource\Pages;

use App\Filament\Admin\Resources\SettingsContactResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSettingsContact extends EditRecord
{
    protected static string $resource = SettingsContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
