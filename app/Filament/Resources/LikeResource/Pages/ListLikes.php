<?php

namespace App\Filament\Resources\LikeResource\Pages;

use App\Filament\Resources\LikeResource;
use App\Models\LikeModel;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLikes extends ListRecords
{
    protected static string $resource = LikeResource::class;

    protected function getRecordId($record)
    {
        return $record->content_id; // Sử dụng content_id làm ID
    }

    protected function getQuery()
    {
        return LikeResource::query()->orderBy('content_id', 'asc'); // Sắp xếp theo content_id
    }

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
