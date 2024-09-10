<?php

namespace App\Filament\App\Resources\Comment1Resource\Pages;

use App\Filament\App\Resources\Comment1Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListComment1s extends ListRecords
{
    protected static string $resource = Comment1Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
