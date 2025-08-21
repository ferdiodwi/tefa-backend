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
        // 1. BUAT PENGGUNA ADMIN (1 Akun)
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // 2. BUAT PENGGUNA ORGANIZER (5 Akun)
        $organizer1 = User::factory()->create([
            'name' => 'Kreasi Muda Jember',
            'email' => 'kreasimuda@gmail.com',
            'password' => Hash::make('jember123'),
            'role' => 'organizer',
        ]);

        $organizer2 = User::factory()->create([
            'name' => 'Jember Event Pro',
            'email' => 'eventpro.jbr@gmail.com',
            'password' => Hash::make('jember123'),
            'role' => 'organizer',
        ]);

        $organizer3 = User::factory()->create([
            'name' => 'Harmoni Musikindo',
            'email' => 'harmonimusik@gmail.com',
            'password' => Hash::make('jember123'),
            'role' => 'organizer',
        ]);

        $organizer4 = User::factory()->create([
            'name' => 'Komunitas Digital Jember',
            'email' => 'kodijaya@gmail.com',
            'password' => Hash::make('jember123'),
            'role' => 'organizer',
        ]);

        $organizer5 = User::factory()->create([
            'name' => 'Pena Cendekia',
            'email' => 'penacendekia@gmail.com',
            'password' => Hash::make('jember123'),
            'role' => 'organizer',
        ]);


        // 3. BUAT ACARA (Total 20 Acara)

        // Acara oleh Kreasi Muda Jember (Komunitas & Kreatif) --
        Event::factory()->create([
            'title' => 'Jember Youth Fest 2025',
            'description' => 'Festival anak muda terbesar di Jember! Menampilkan musik, seni, dan workshop kreatif.',
            'organizer_id' => $organizer1->id,
            'start_datetime' => '2025-11-22 10:00:00',
            'end_datetime' => '2025-11-23 22:00:00',
            'venue' => 'Alun-Alun Jember',
            'status' => 'published',
        ]);
        Event::factory()->create([
            'title' => 'Workshop Fotografi: Potret Humanis',
            'description' => 'Belajar teknik memotret human interest bersama fotografer profesional.',
            'organizer_id' => $organizer1->id,
            'start_datetime' => '2025-12-07 09:00:00',
            'end_datetime' => '2025-12-07 15:00:00',
            'venue' => 'Sevendream City',
            'status' => 'published',
        ]);
        Event::factory()->create([
            'title' => 'Pasar Kreatif Lokal Jember',
            'description' => 'Pameran produk-produk unggulan dari UMKM dan seniman lokal Jember.',
            'organizer_id' => $organizer1->id,
            'start_datetime' => '2026-01-18 10:00:00',
            'end_datetime' => '2026-01-18 20:00:00',
            'venue' => 'GOR PKPSO Kaliwates',
            'status' => 'draft',
        ]);
        Event::factory()->create([
            'title' => 'Charity Run: Lari untuk Pendidikan',
            'description' => 'Acara lari amal 5K untuk menggalang dana bagi sekolah-sekolah di pinggiran.',
            'organizer_id' => $organizer1->id,
            'start_datetime' => '2026-02-15 06:00:00',
            'end_datetime' => '2026-02-15 10:00:00',
            'venue' => 'Jember Sport Garden (JSG)',
            'status' => 'published',
        ]);

        // Acara oleh Jember Event Pro (Profesional & Pameran) --
        Event::factory()->create([
            'title' => 'Jember Wedding Expo 2026',
            'description' => 'Pameran vendor pernikahan terlengkap, mulai dari katering, dekorasi, hingga MUA.',
            'organizer_id' => $organizer2->id,
            'start_datetime' => '2026-02-08 10:00:00',
            'end_datetime' => '2026-02-09 21:00:00',
            'venue' => 'Convention Hall Cempaka Hill Hotel',
            'status' => 'published',
        ]);
        Event::factory()->create([
            'title' => 'Festival Kuliner Pedas Nusantara',
            'description' => 'Kumpulan kuliner pedas dari seluruh Indonesia. Berani coba?',
            'organizer_id' => $organizer2->id,
            'start_datetime' => '2025-10-25 11:00:00',
            'end_datetime' => '2025-10-26 22:00:00',
            'venue' => 'Lapangan Parkir Lippo Plaza Jember',
            'status' => 'published',
        ]);
        Event::factory()->create([
            'title' => 'Pameran Otomotif Jember 2025',
            'description' => 'Pameran mobil dan motor terbaru dari berbagai merek ternama.',
            'organizer_id' => $organizer2->id,
            'start_datetime' => '2025-12-12 10:00:00',
            'end_datetime' => '2025-12-14 21:00:00',
            'venue' => 'Jember Sport Garden (JSG)',
            'status' => 'published',
        ]);
        Event::factory()->create([
            'title' => 'Job Fair Terpadu Jember',
            'description' => 'Bursa kerja yang diikuti oleh puluhan perusahaan nasional dan multinasional.',
            'organizer_id' => $organizer2->id,
            'start_datetime' => '2026-03-04 09:00:00',
            'end_datetime' => '2026-03-05 16:00:00',
            'venue' => 'Gedung Soetardjo Universitas Jember',
            'status' => 'draft',
        ]);

        // Acara oleh Harmoni Musikindo (Konser & Musik) --
        Event::factory()->create([
            'title' => 'Konser Intim: Senandung Malam',
            'description' => 'Menampilkan musisi indie lokal dalam suasana akustik yang hangat.',
            'organizer_id' => $organizer3->id,
            'start_datetime' => '2025-11-29 19:00:00',
            'end_datetime' => '2025-11-29 22:00:00',
            'venue' => 'Kafe Tegalan',
            'status' => 'published',
        ]);
        Event::factory()->create([
            'title' => 'Jember Ambyar Fest',
            'description' => 'Festival musik dangdut dan campursari bersama artis-artis Jawa Timur.',
            'organizer_id' => $organizer3->id,
            'start_datetime' => '2026-01-24 18:00:00',
            'end_datetime' => '2026-01-24 23:30:00',
            'venue' => 'GOR PKPSO Kaliwates',
            'status' => 'published',
        ]);
        Event::factory()->create([
            'title' => 'Tribute to Koes Plus',
            'description' => 'Malam nostalgia membawakan lagu-lagu legendaris dari Koes Plus.',
            'organizer_id' => $organizer3->id,
            'start_datetime' => '2025-12-20 19:30:00',
            'end_datetime' => '2025-12-20 22:00:00',
            'venue' => 'Aula PTPN X Jember',
            'status' => 'published',
        ]);
        Event::factory()->create([
            'title' => 'Jazz at The Mountain',
            'description' => 'Menikmati alunan musik jazz dengan pemandangan pegunungan Argopuro.',
            'organizer_id' => $organizer3->id,
            'start_datetime' => '2026-04-11 16:00:00',
            'end_datetime' => '2026-04-11 21:00:00',
            'venue' => 'Rembangan',
            'status' => 'draft',
        ]);

        // Acara oleh Komunitas Digital Jember (Teknologi & Workshop) --
        Event::factory()->create([
            'title' => 'Seminar: Masa Depan AI',
            'description' => 'Mengupas tuntas perkembangan Artificial Intelligence dan dampaknya bagi industri.',
            'organizer_id' => $organizer4->id,
            'start_datetime' => '2025-11-15 09:00:00',
            'end_datetime' => '2025-11-15 13:00:00',
            'venue' => 'Aula Fakultas Ilmu Komputer UNEJ',
            'status' => 'published',
        ]);
        Event::factory()->create([
            'title' => 'Bootcamp: Full-Stack Web Developer',
            'description' => 'Program intensif 3 hari untuk belajar membangun aplikasi web dari nol.',
            'organizer_id' => $organizer4->id,
            'start_datetime' => '2026-02-20 09:00:00',
            'end_datetime' => '2026-02-22 17:00:00',
            'venue' => 'Coworking Space Jember',
            'status' => 'published',
        ]);
        Event::factory()->create([
            'title' => 'Workshop UI/UX untuk Pemula',
            'description' => 'Pelatihan dasar merancang antarmuka aplikasi yang ramah pengguna.',
            'organizer_id' => $organizer4->id,
            'start_datetime' => '2026-01-10 10:00:00',
            'end_datetime' => '2026-01-10 16:00:00',
            'venue' => 'Politeknik Negeri Jember',
            'status' => 'published',
        ]);
        Event::factory()->create([
            'title' => 'Talkshow Digital Marketing 2026',
            'description' => 'Strategi pemasaran digital terbaru untuk meningkatkan omzet bisnis Anda.',
            'organizer_id' => $organizer4->id,
            'start_datetime' => '2026-03-21 13:00:00',
            'end_datetime' => '2026-03-21 16:00:00',
            'venue' => 'Aston Hotel Jember',
            'status' => 'draft',
        ]);

        // Acara oleh Pena Cendekia (Edukasi & Sastra) --
        Event::factory()->create([
            'title' => 'Bedah Buku "Bumi Manusia"',
            'description' => 'Diskusi mendalam mengenai karya sastra legendaris Pramoedya Ananta Toer.',
            'organizer_id' => $organizer5->id,
            'start_datetime' => '2025-11-08 15:00:00',
            'end_datetime' => '2025-11-08 17:00:00',
            'venue' => 'Perpustakaan Daerah Jember',
            'status' => 'published',
        ]);
        Event::factory()->create([
            'title' => 'Seminar Beasiswa Luar Negeri',
            'description' => 'Kiat dan trik mendapatkan beasiswa S2/S3 di Eropa dan Amerika.',
            'organizer_id' => $organizer5->id,
            'start_datetime' => '2026-01-17 09:00:00',
            'end_datetime' => '2026-01-17 12:00:00',
            'venue' => 'Gedung Soetardjo Universitas Jember',
            'status' => 'published',
        ]);
        Event::factory()->create([
            'title' => 'Lomba Menulis Cerpen Nasional',
            'description' => 'Kompetisi menulis cerita pendek tingkat nasional dengan tema "Warisan Budaya".',
            'organizer_id' => $organizer5->id,
            'start_datetime' => '2025-12-01 00:00:00',
            'end_datetime' => '2026-02-28 23:59:59',
            'venue' => 'Online',
            'status' => 'published',
        ]);
        Event::factory()->create([
            'title' => 'Pelatihan Public Speaking',
            'description' => 'Tingkatkan kepercayaan diri dan kemampuan berbicara di depan umum.',
            'organizer_id' => $organizer5->id,
            'start_datetime' => '2026-03-07 09:00:00',
            'end_datetime' => '2026-03-07 16:00:00',
            'venue' => 'Hotel Dafam Jember',
            'status' => 'draft',
        ]);
    }
}
