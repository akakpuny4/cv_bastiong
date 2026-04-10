<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PiutangResource\Pages;
use App\Filament\Resources\PiutangResource\RelationManagers;
use App\Models\Piutang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PiutangResource extends Resource
{
    protected static ?string $model = Piutang::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_pelanggan')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Misal: PT ABC / Bapak Budi'),

                Forms\Components\DatePicker::make('tanggal_ambil')
                    ->required()
                    ->default(now()),

                Forms\Components\TextInput::make('jumlah_pengambilan')
                    ->label('Jumlah Pengambilan (Hutang Awal)')
                    ->numeric()
                    ->default(0)
                    ->prefix('Rp'),

                Forms\Components\TextInput::make('bunga')
                    ->label('Bunga Ditagih (Jika ada)')
                    ->numeric()
                    ->default(0)
                    ->prefix('Rp'),

                Forms\Components\TextInput::make('jumlah_pembayaran')
                    ->label('Jumlah Sudah Dibayar')
                    ->numeric()
                    ->default(0)
                    ->prefix('Rp'),

                Forms\Components\TextInput::make('saldo_piutang')
                    ->label('Sisa Piutang')
                    ->numeric()
                    ->default(0)
                    ->prefix('Rp')
                    ->disabled() // Dimatikan agar tidak bisa diubah manual
                    ->helperText('Akan dihitung otomatis: (Pengambilan + Bunga) - Pembayaran.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_pelanggan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal_ambil')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('jumlah_pengambilan')
                    ->label('Hutang Awal')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('bunga')
                    ->label('Bunga')
                    ->money('IDR')
                    ->color('warning'), 

                Tables\Columns\TextColumn::make('jumlah_pembayaran')
                    ->label('Sudah Dibayar')
                    ->money('IDR')
                    ->color('success'), 

                Tables\Columns\TextColumn::make('saldo_piutang')
                    ->label('Sisa Hutang')
                    ->money('IDR')
                    ->color('danger') 
                    ->sortable(),
            ])
            ->defaultSort('tanggal_ambil', 'desc')
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
            'index' => Pages\ListPiutangs::route('/'),
            'create' => Pages\CreatePiutang::route('/create'),
            'edit' => Pages\EditPiutang::route('/{record}/edit'),
        ];
    }
}
