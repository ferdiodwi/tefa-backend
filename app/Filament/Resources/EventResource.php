<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Event';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul Acara')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                Forms\Components\RichEditor::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('venue')
                    ->label('Lokasi/Tempat')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draf',
                        'published' => 'Diterbitkan',
                    ])
                    ->required(),

                Forms\Components\DateTimePicker::make('start_datetime')
                    ->label('Waktu Mulai')
                    ->required(),

                Forms\Components\DateTimePicker::make('end_datetime')
                    ->label('Waktu Selesai')
                    ->required(),

                // untuk memilih Organizer (HANYA UNTUK ADMIN)
                Forms\Components\Select::make('organizer_id')
                    ->label('Penyelenggara')
                    ->options(User::where('role', 'organizer')->pluck('name', 'id'))
                    ->searchable()
                    ->required()

                    ->visible(fn () => auth()->user()->role === 'admin'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Judul')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('venue')->label('Lokasi'),
                Tables\Columns\TextColumn::make('start_datetime')->label('Waktu Mulai')->dateTime()->sortable(),
                Tables\Columns\TextColumn::make('status')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                    }),
                // Tampilkan nama penyelenggara (admin)
                Tables\Columns\TextColumn::make('organizer.name')->label('Penyelenggara')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        // tampil semua event (admin)
        if (auth()->user()->role === 'admin') {
            return parent::getEloquentQuery();
        }

        // event milik sendiri
        return parent::getEloquentQuery()->where('organizer_id', auth()->id());
    }
}
