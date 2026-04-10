<?php

namespace App\Filament\Resources\KuitansiResource\Pages;

use App\Filament\Resources\KuitansiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKuitansi extends EditRecord
{
    protected static string $resource = KuitansiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
