<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ScreeningResource\Pages;
use App\Filament\Resources\ScreeningResource\RelationManagers;
use App\Models\Screening;
use App\Models\Kuesioner;
use App\Models\Layanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ScreeningResource extends Resource
{
    protected static ?string $model = Screening::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Forms\Form $form): Forms\Form
{
    return $form
        ->schema([
            // Pilih Pasien
            Forms\Components\Select::make('pasien_id')
                ->label('Pasien')
                ->relationship('pasien', 'nama')
                ->required(),

            // Pilih Layanan
            Forms\Components\Select::make('layanan_id')
                ->label('Layanan')
                ->relationship('layanan', 'nama')
                ->required()
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set) {
                    // Ambil layanan terkait dengan ID yang dipilih dan semua pertanyaannya
                    $layanan = Layanan::with('kuesioners')->find($state);
                    
                    // Jika layanan ada dan memiliki pertanyaan terkait
                    if ($layanan && $layanan->kuesioners->count() > 0) {
                        $set('jawaban_screening', $layanan->kuesioners->map(function ($question) {
                            return [
                                'pertanyaan_id' => $question->id,
                                'pertanyaan' => $question->pertanyaan,
                                'jawaban' => null, // Jawaban default null
                            ];
                        })->toArray());
                    } else {
                        $set('jawaban_screening', []); // Kosongkan jika tidak ada pertanyaan
                    }
                }),

            // Repeater untuk jawaban screening
            Forms\Components\Repeater::make('jawaban_screening')
                ->label('Kuesioner')
                ->schema([
                    Forms\Components\Hidden::make('pertanyaan_id'), // Hidden ID Pertanyaan
                    Forms\Components\TextInput::make('pertanyaan')
                        ->disabled() // Pertanyaan hanya bisa dibaca
                        ->label('Pertanyaan'),
                    Forms\Components\Select::make('jawaban') // Jawaban screening
                        ->label('Jawaban Screening')
                        ->options([ // Opsi jawaban
                            true => 'YA',
                            false => 'TIDAK',
                        ])
                        ->required(),
                ])
                ->disableItemDeletion() // Menonaktifkan penghapusan item pada repeater
                ->columns(2) // Membagi kolom dalam repeater menjadi 2
                ->columnSpan('full'), // Mengatur repeater untuk memenuhi seluruh lebar form
        ]);
}


    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pasien.nama')
                    ->label('Nama Pasien'),
                Tables\Columns\TextColumn::make('layanan.nama')
                    ->label('Nama Layanan'),
                Tables\Columns\TextColumn::make('skor')
                    ->label('Skor')
                    ->color(fn ($record) => 
                    $record->skor < 4 ? 'success' : 
                    ($record->skor < 10 ? 'warning' : 'danger')
                ),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
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
            'index' => Pages\ListScreenings::route('/'),
            'create' => Pages\CreateScreening::route('/create'),
            'edit' => Pages\EditScreening::route('/{record}/edit'),
        ];
    }
}
