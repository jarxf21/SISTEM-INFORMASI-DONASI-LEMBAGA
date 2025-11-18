<?php

namespace App\Filament\Admin\Resources\HeroSectionResource\Pages;

use App\Filament\Admin\Resources\HeroSectionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHeroSection extends EditRecord
{
    protected static string $resource = HeroSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
