<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Filament\Resources\EventResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;

    // Tambahkan metode ini
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Jika user adalah organizer, tambahkan ID-nya ke data
        if (auth()->user()->role === 'organizer') {
            $data['organizer_id'] = auth()->id();
        }

        return $data;
    }
}