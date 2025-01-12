<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OnlineScreeningResource\Pages;
use App\Filament\Resources\OnlineScreeningResource\RelationManagers;
use App\Models\OnlineScreening;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OnlineScreeningResource extends Resource
{
    protected static ?string $model = OnlineScreening::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jenis_kelamin')->label('Jenis Kelamin'),
                TextColumn::make('usia')->label('Usia'),
                TextColumn::make('skor')->label('Skor'),
                TextColumn::make('status')->label('Status')
                ->formatStateUsing(fn ($state) => ucfirst($state))
                ->color(fn ($state) => match ($state) {
                'Rendah' => 'success', // Hijau
                'Sedang' => 'warning', // Oranye
                'Tinggi' => 'danger',  // Merah
                default => 'secondary', // Default
                })
            ])
            ->filters([
                //
            ])
            ->actions([
                
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
            'index' => Pages\ListOnlineScreenings::route('/'),
            'create' => Pages\CreateOnlineScreening::route('/create'),
            'edit' => Pages\EditOnlineScreening::route('/{record}/edit'),
        ];
    }
}
