<?php

namespace App\Filament\App\Resources\Content1Resource\Pages;

use App\Filament\App\Resources\Content1Resource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContent1s extends ListRecords
{
    protected static string $resource = Content1Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
