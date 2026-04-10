<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StokResource\Pages;
use App\Filament\Resources\StokResource\RelationManagers;
use App\Models\Stok;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StokResource extends Resource
{
    protected static ?string $model = Stok::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggal')
                    ->required()
                    ->default(now()), // Otomatis terisi tanggal hari ini
                
                Forms\Components\Select::make('barang_id')
                    ->relationship('barang', 'nama_barang') // Mengambil data dari tabel Barangs
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Nama Barang'),

                Forms\Components\TextInput::make('nama_pembeli_faktur_kapal')
                    ->label('Nama Pembeli / No Faktur / Nama Kapal')
                    ->maxLength(255),

                Forms\Components\TextInput::make('aspal_masuk')
                    ->numeric()
                    ->default(0),

                Forms\Components\TextInput::make('stok_keluar_jual')
                    ->numeric()
                    ->default(0),

                Forms\Components\TextInput::make('stok_keluar_gudang')
                    ->numeric()
                    ->default(0),

                Forms\Components\TextInput::make('saldo_akhir')
                    ->numeric()
                    ->default(0)
                    ->helperText('Catatan: Nanti kita akan buat sistem otomatis menghitung saldo ini di Tahap Logic.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggal')
                    ->date('d M Y')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('barang.nama_barang') // Menampilkan nama barang, bukan ID-nya
                    ->label('Barang')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nama_pembeli_faktur_kapal')
                    ->label('Keterangan / Faktur')
                    ->searchable(),

                Tables\Columns\TextColumn::make('aspal_masuk')
                    ->label('Masuk')
                    ->badge()
                    ->color('success'), // Berwarna hijau

                Tables\Columns\TextColumn::make('stok_keluar_jual')
                    ->label('Keluar (Jual)')
                    ->badge()
                    ->color('warning'), // Berwarna kuning/oranye

                Tables\Columns\TextColumn::make('stok_keluar_gudang')
                    ->label('Keluar (Gudang)')
                    ->badge()
                    ->color('danger'), // Berwarna merah

                Tables\Columns\TextColumn::make('saldo_akhir')
                    ->label('Saldo Akhir')
                    ->sortable(),
            ])
            ->defaultSort('tanggal', 'desc') // Otomatis urutkan dari tanggal terbaru
            ->filters([
                // Nanti kita bisa tambahkan filter rentang tanggal di sini
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
            'index' => Pages\ListStoks::route('/'),
            'create' => Pages\CreateStok::route('/create'),
            'edit' => Pages\EditStok::route('/{record}/edit'),
        ];
    }
}
