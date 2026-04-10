<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KuitansiResource\Pages;
use App\Filament\Resources\KuitansiResource\RelationManagers;
use App\Models\Kuitansi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KuitansiResource extends Resource
{
    protected static ?string $model = Kuitansi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('no_kuitansi')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Misal: 001/KU/BJT/2026'),

                Forms\Components\DatePicker::make('tanggal')
                    ->required()
                    ->default(now()),

                Forms\Components\Select::make('jenis_kuitansi')
                    ->options([
                        'Penerimaan' => 'Kuitansi Penerimaan',
                        'Pengeluaran' => 'Kuitansi Pengeluaran',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('terima_dari')
                    ->label('Terima Dari / Bayar Kepada')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('untuk_pembayaran')
                    ->required()
                    ->columnSpanFull() // Agar kotak teksnya lebar
                    ->placeholder('Misal: Pembayaran DP Aspal Emulsi 10 Drum'),

                Forms\Components\TextInput::make('jumlah_uang')
                    ->numeric()
                    ->required()
                    ->prefix('Rp')
                    ->live(onBlur: true) // Fitur untuk memicu aksi saat kita selesai ngetik angka
                    ->helperText('Angka jumlah uang'),

                Forms\Components\TextInput::make('terbilang')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Misal: Sepuluh Juta Rupiah')
                    ->helperText('Tuliskan ejaan hurufnya'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no_kuitansi')
                    ->searchable(),

                Tables\Columns\TextColumn::make('tanggal')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('jenis_kuitansi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Penerimaan' => 'success',
                        'Pengeluaran' => 'danger',
                    }),

                Tables\Columns\TextColumn::make('terima_dari')
                    ->searchable()
                    ->limit(20),

                Tables\Columns\TextColumn::make('jumlah_uang')
                    ->money('IDR')
                    ->sortable(),
            ])
            ->defaultSort('tanggal', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('jenis_kuitansi')
                    ->options([
                        'Penerimaan' => 'Kuitansi Penerimaan',
                        'Pengeluaran' => 'Kuitansi Pengeluaran',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Cetak PDF')
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    ->url(fn (Kuitansi $record) => route('kuitansi.cetak', $record->id))
                    ->openUrlInNewTab(),
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
            'index' => Pages\ListKuitansis::route('/'),
            'create' => Pages\CreateKuitansi::route('/create'),
            'edit' => Pages\EditKuitansi::route('/{record}/edit'),
        ];
    }
}
