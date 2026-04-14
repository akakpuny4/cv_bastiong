<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BukuKasResource\Pages;
use App\Filament\Resources\BukuKasResource\RelationManagers;
use App\Models\BukuKas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\RawJs;
class BukuKasResource extends Resource
{
    protected static ?string $model = BukuKas::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('tanggal')
                    ->required()
                    ->default(now()),

                Forms\Components\Select::make('rekening_id')
                    ->relationship('rekening', 'nama_akun') // Ambil data dari tabel Rekenings
                    ->required()
                    ->searchable()
                    ->preload()
                    ->label('Rekening Sumber/Tujuan'),

                Forms\Components\TextInput::make('uraian')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Misal: DP Penjualan Aspal Emulsi'),

                Forms\Components\Select::make('kategori_pengeluaran')
                    ->options([
                        'Operasional' => 'Operasional Aspal',
                        'Kantor' => 'Pengeluaran Kantor',
                        'Proyek' => 'Pengeluaran Proyek',
                        'Lain-lain' => 'Pengeluaran Lain',
                    ])
                    ->label('Kategori (Jika Pengeluaran)'),

                Forms\Components\TextInput::make('debet')
                    ->label('Uang Masuk (Debet)')
                    ->numeric()
                    ->prefix('Rp')
                    ->mask(RawJs::make('$money($input, \',\', \'.\')'))
                    ->stripCharacters('.')
                    // BARIS BARU DI BAWAH INI
                    ->dehydrateStateUsing(fn ($state) => $state ?? 0),

                Forms\Components\TextInput::make('kredit')
                    ->label('Uang Keluar (Kredit)')
                    ->numeric()
                    ->prefix('Rp')
                    ->mask(RawJs::make('$money($input, \',\', \'.\')'))
                    ->stripCharacters('.')
                    // BARIS BARU DI BAWAH INI
                    ->dehydrateStateUsing(fn ($state) => $state ?? 0),

                Forms\Components\TextInput::make('saldo_berjalan')
                    ->numeric()
                    ->prefix('Rp')
                    ->disabled()
                    ->mask(RawJs::make('$money($input, \',\', \'.\')'))
                    ->stripCharacters('.')
                    ->helperText('Otomatis dihitung oleh sistem.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tanggal')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('rekening.nama_akun')
                    ->label('Rekening')
                    ->searchable()
                    ->sortable()
                    ->badge(), // Kasih gaya badge agar rapi

                Tables\Columns\TextColumn::make('uraian')
                    ->searchable()
                    ->limit(30), // Batasi panjang teks agar tabel tidak melebar

                Tables\Columns\TextColumn::make('debet')
                    ->label('Masuk (Debet)')
                    ->money('IDR')
                    ->color('success') // Warna hijau
                    ->sortable(),

                Tables\Columns\TextColumn::make('kredit')
                    ->label('Keluar (Kredit)')
                    ->money('IDR')
                    ->color('danger') // Warna merah
                    ->sortable(),

                Tables\Columns\TextColumn::make('saldo_berjalan')
                    ->label('Saldo Berjalan')
                    ->money('IDR')
                    ->sortable(),
            ])
            ->defaultSort('tanggal', 'desc')
            ->filters([
                // Filter berdasarkan Rekening agar mudah mengecek mutasi per bank
                Tables\Filters\SelectFilter::make('rekening_id')
                    ->relationship('rekening', 'nama_akun')
                    ->label('Filter Rekening'),
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
            'index' => Pages\ListBukuKas::route('/'),
            'create' => Pages\CreateBukuKas::route('/create'),
            'edit' => Pages\EditBukuKas::route('/{record}/edit'),
        ];
    }
}
