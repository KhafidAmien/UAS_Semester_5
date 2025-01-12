<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PasienResource\Pages;
use App\Filament\Resources\PasienResource\RelationManagers;
use App\Models\Pasien;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PasienResource extends Resource
{
    protected static ?string $model = Pasien::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('kode_unik')
                    ->disabled()
                    ->default(fn () => 'P-' . strtoupper(uniqid()))
                    ->label('Kode Unik'),
                TextInput::make('nama')
                    ->required()
                    ->label('Nama'),
                TextInput::make('usia')
                    ->required()
                    ->numeric()
                    ->label('Usia'),
                TextInput::make('tinggi_badan')
                    ->required()
                    ->numeric()
                    ->label('Tinggi Badan (cm)'),
                TextInput::make('berat_badan')
                    ->required()
                    ->numeric()
                    ->label('Berat Badan (kg)'),
                Select::make('jenis_kelamin')
                    ->required()
                    ->label('Jenis Kelamin')
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ]),
                DatePicker::make('tanggal_lahir')
                    ->required()
                    ->label('Tanggal Lahir'),
                TextInput::make('nik')
                    ->required()
                    ->rules(function ($record) {
                        return [
                            'required',
                            'string',
                            Rule::unique('pasiens', 'nik')->ignore($record ? $record->id : null), // Menggunakan $record->id untuk mengabaikan NIK saat mengedit
                        ];
                    })
                    ->label('NIK'),
                    Forms\Components\TextInput::make('screening.status')
                        ->label('Status Screening')
                        ->disabled() // Disable agar tidak bisa diedit langsung
                        ->default(function ($get, $record) {
                            
                            // Pastikan record ada dan screenings ter-load
                            if ($record && $record->screening()->exists()) {
                                // Ambil status dari screening pertama yang ditemukan
                                return $record->screening()->latest()->first()->status;
                            }
                            
                            // Jika tidak ada data screening, tampilkan pesan default
                            return 'Belum melakukan Screening';
                        }),
                
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->sortable(),
                Tables\Columns\TextColumn::make('kode_unik')
                    ->label('Nomor Pasien')
                    ->sortable(),
                Tables\Columns\TextColumn::make('usia')
                    ->label('Usia')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->label('Jenis Kelamin'),
                Tables\Columns\TextColumn::make('tanggal_lahir')
                    ->label('Tanggal Lahir'),
                Tables\Columns\TextColumn::make('screening.status')
                    ->label('Status Diabetes')
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
            'index' => Pages\ListPasiens::route('/'),
            'create' => Pages\CreatePasien::route('/create'),
            'edit' => Pages\EditPasien::route('/{record}/edit'),
        ];
    }
}
