<?php

namespace App\Filament\Resources\FollowResource\Pages;

use App\Filament\Resources\FollowResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFollow extends ViewRecord
{
    protected static string $resource = FollowResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
