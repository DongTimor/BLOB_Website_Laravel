<?php

namespace App\Filament\App\Resources\Content1Resource\Pages;

use App\Filament\App\Resources\Content1Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContent1 extends EditRecord
{
    protected static string $resource = Content1Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
