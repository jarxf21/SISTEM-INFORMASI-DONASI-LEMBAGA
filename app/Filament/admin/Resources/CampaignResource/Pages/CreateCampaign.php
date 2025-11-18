<?php

namespace App\Filament\Admin\Resources\CampaignResource\Pages;

use App\Filament\Admin\Resources\CampaignResource;
use Filament\Actions;
// use Filament\Resources\Pages\CreateRecord;
use App\Filament\Admin\Pages\BaseCreateRecord;

class CreateCampaign extends  BaseCreateRecord
{
    protected static string $resource = CampaignResource::class;
}
