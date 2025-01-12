<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LayananResource\Pages;
use App\Filament\Resources\LayananResource\RelationManagers;
use App\Models\Layanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LayananResource extends Resource
{
    protected static ?string $model = Layanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Forms\Form $form): Forms\Form
{
    return $form
        ->schema([
            // Input untuk nama layanan
            Forms\Components\TextInput::make('nama')
                ->label('Nama Layanan')
                ->required(),

            // Input untuk kategori layanan (jika ada kategori layanan)
            Forms\Components\Select::make('kategori_layanan_id')
                ->label('Kategori Layanan')
                ->relationship('kategori', 'nama') // Relasi dengan kategori layanan
                ->required(),

            // Input untuk pertanyaan yang terkait dengan layanan ini
            Forms\Components\HasManyRepeater::make('kuesioners')
                ->label('Kuesioner')
                ->relationship('kuesioners') // Relasi dengan tabel `kuesioners`
                ->schema([
                    Forms\Components\TextInput::make('pertanyaan')
                        ->label('Pertanyaan')
                        ->required(),

                    Forms\Components\Select::make('jawaban_kuesioner')
                        ->label('Jawaban Benar')
                        ->options([
                            true => 'YA', // Menyimpan sebagai boolean true
                            false => 'TIDAK', // Menyimpan sebagai boolean false
                        ])
                        ->default(true)
                        ->required(),
                ])
                ->columns(2) // Menambahkan grid dengan 2 kolom
                ->columnSpan('full'),
        ]);
}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Layanan'),

                Tables\Columns\TextColumn::make('kategori.nama')
                    ->label('Kategori Layanan'),
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
            'index' => Pages\ListLayanans::route('/'),
            'create' => Pages\CreateLayanan::route('/create'),
            'edit' => Pages\EditLayanan::route('/{record}/edit'),
        ];
    }
}
