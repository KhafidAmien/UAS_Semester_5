<?php

namespace App\Filament\Resources\ScreeningThresholdResource\Pages;

use App\Filament\Resources\ScreeningThresholdResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditScreeningThreshold extends EditRecord
{
    protected static string $resource = ScreeningThresholdResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
