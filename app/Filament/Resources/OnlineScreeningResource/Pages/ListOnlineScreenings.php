<?php

namespace App\Filament\Resources\OnlineScreeningResource\Pages;

use App\Filament\Resources\OnlineScreeningResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOnlineScreenings extends ListRecords
{
    protected static string $resource = OnlineScreeningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
