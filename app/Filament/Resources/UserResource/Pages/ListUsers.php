<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            Tab::make('All')
                ->modifyQueryUsing(fn ($query) => $query), // Không cần thay đổi gì cho tab "All"
            Tab::make('This week')
                ->modifyQueryUsing(fn ($query) => $query->where('created_at', '>=', now()->subWeek())), // Sửa lại cho tab "This week"
            Tab::make('This month')
                ->modifyQueryUsing(fn ($query) => $query->where('created_at', '>=', now()->subMonth())), // Sửa lại cho tab "This month"
            Tab::make('This year')
                ->modifyQueryUsing(fn ($query) => $query->where('created_at', '>=', now()->subYear())), // Sửa lại cho tab "This year"
        ];
    }
}