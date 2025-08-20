<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\EventResource;
use App\Models\Event;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentEvents extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Event Terbaru';

    public function table(Table $table): Table
    {
        // Tentukan query dasar
        $query = Event::query();

        // Sesuaikan query berdasarkan role pengguna
        if (auth()->user()->role === 'organizer') {
            $query->where('organizer_id', auth()->id());
        }

        // Ambil 5 event terbaru
        $query->latest()->limit(5);

        return $table
            ->query($query)
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Judul Event'),
                Tables\Columns\TextColumn::make('organizer.name')->label('Organizer'),
                Tables\Columns\TextColumn::make('start_datetime')->label('Waktu Mulai')->dateTime(),
            ])
            ->actions([
                // Tambahkan tombol untuk langsung mengedit event
                Tables\Actions\Action::make('edit')
                    ->label('Edit')
                    ->url(fn (Event $record): string => EventResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}
