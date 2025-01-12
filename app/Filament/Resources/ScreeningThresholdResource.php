<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScreeningThresholdResource\Pages;
use App\Models\ScreeningThreshold;
use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;

class ScreeningThresholdResource extends Resource
{
    protected static ?string $model = ScreeningThreshold::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('layanan_id')
                    ->label('Layanan')
                    ->relationship('layanan', 'nama') // Menampilkan layanan terkait
                    ->required(),
                    
                Forms\Components\TextInput::make('rendah_threshold')
                    ->label('Ambang Batas Status Rendah')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('sedang_threshold')
                    ->label('Ambang Batas Status Sedang')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('tinggi_threshold')
                    ->label('Ambang Batas Status Tinggi')
                    ->numeric()
                    ->required(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('layanan.nama')
                    ->label('Nama Layanan'),
                Tables\Columns\TextColumn::make('rendah_threshold')
                    ->label('Status Rendah'),
                Tables\Columns\TextColumn::make('sedang_threshold')
                    ->label('Status Sedang'),
                Tables\Columns\TextColumn::make('tinggi_threshold')
                    ->label('Status Tinggi'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListScreeningThresholds::route('/'),
            'create' => Pages\CreateScreeningThreshold::route('/create'),
            'edit' => Pages\EditScreeningThreshold::route('/{record}/edit'),
        ];
    }

    

        public static function getNavigationLabel(): string
    {
        return 'Ambang Batas Screening';
    }

}

