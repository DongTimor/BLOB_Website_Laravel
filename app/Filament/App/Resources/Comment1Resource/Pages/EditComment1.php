<?php

namespace App\Filament\App\Resources\Comment1Resource\Pages;

use App\Filament\App\Resources\Comment1Resource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditComment1 extends EditRecord
{
    protected static string $resource = Comment1Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
