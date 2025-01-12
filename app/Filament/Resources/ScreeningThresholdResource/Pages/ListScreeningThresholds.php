<?php

namespace App\Filament\Resources\ScreeningThresholdResource\Pages;

use App\Filament\Resources\ScreeningThresholdResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListScreeningThresholds extends ListRecords
{
    protected static string $resource = ScreeningThresholdResource::class;

    // Menambahkan tombol untuk membuat data baru
    protected function getActions(): array
    {
        return [
            // Tombol untuk membuat data baru
            Actions\CreateAction::make(),
        ];
    }

    // Anda bisa menambahkan logika tambahan di sini jika perlu
}
