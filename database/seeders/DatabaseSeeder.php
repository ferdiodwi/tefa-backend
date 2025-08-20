<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User Admin
        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // 2. Buat 2 User Organizer
        $organizer1 = User::factory()->create([
            'name' => 'ferdio',
            'email' => 'ferdio@gmail.com',
            'password' => Hash::make('ferdio123'),
            'role' => 'organizer',
        ]);

        $organizer2 = User::factory()->create([
            'name' => 'dimas',
            'email' => 'dimas@gmail.com',
            'password' => Hash::make('dimas123'),
            'role' => 'organizer',
        ]);

        // 3. Buat Event untuk masing-masing organizer
        Event::factory()->create([
            'title' => 'Konser Musik Kemerdekaan',
            'organizer_id' => $organizer1->id,
            'start_datetime' => '2025-08-17 19:00:00',
            'end_datetime' => '2025-08-17 23:00:00',
            'venue' => 'Lapangan Merdeka',
            'status' => 'published',
        ]);

        Event::factory()->create([
            'title' => 'Workshop Teknologi AI',
            'organizer_id' => $organizer2->id,
            'start_datetime' => '2025-07-20 09:00:00',
            'end_datetime' => '2025-07-20 17:00:00',
            'venue' => 'Gedung Inovasi',
            'status' => 'draft',
        ]);
    }
}
