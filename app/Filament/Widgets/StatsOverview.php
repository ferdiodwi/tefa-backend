<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $currentUser = auth()->user();
        $stats = [];

        // --- Statistik untuk Event ---
        if ($currentUser->role === 'admin') {
            // Admin melihat total semua event
            $stats[] = Stat::make('Total Event', Event::count())
                ->description('Semua event yang terdaftar')
                ->icon('heroicon-o-calendar-days');
        } else {
            // Organizer hanya melihat total event miliknya
            $stats[] = Stat::make('Total Event Saya', Event::where('organizer_id', $currentUser->id)->count())
                ->description('Event yang Anda kelola')
                ->icon('heroicon-o-calendar-days');
        }

        // --- Statistik Pengguna (Hanya untuk Admin) ---
        if ($currentUser->role === 'admin') {
            $stats[] = Stat::make('Total Pengguna', User::count())
                ->description('Admin & Organizer')
                ->icon('heroicon-o-users');

            $stats[] = Stat::make('Total Organizer', User::where('role', 'organizer')->count())
                ->description('Pengguna dengan role organizer')
                ->icon('heroicon-o-user-group');
        }

        return $stats;
    }
}
