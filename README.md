# EventHub API & Admin Panel

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Filament](https://img.shields.io/badge/Filament-A53737?style=for-the-badge&logo=php&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-316192?style=for-the-badge&logo=postgresql&logoColor=white)

Ini adalah backend project untuk sebuah platform manajemen event bernama "Tefa Backend". Proyek ini menyediakan REST API yang lengkap untuk pengelolaan event dan sebuah Admin Panel fungsional yang dibangun dengan Laravel Filament untuk administrasi data yang mudah.

## 📋 Fitur Utama

-   **RESTful API**: Menyediakan endpoint untuk semua operasi CRUD (Create, Read, Update, Delete) pada data event.
-   **Otentikasi JWT**: Sistem otentikasi yang aman menggunakan JSON Web Tokens (JWT).
-   **Hak Akses Berbasis Peran (RBAC)**:
    -   **Admin**: Akses penuh untuk mengelola semua data (event dan pengguna).
    -   **Organizer**: Hanya bisa mengelola event miliknya sendiri.
-   **Query Lanjutan**: API mendukung paginasi, pencarian berdasarkan judul, filter berdasarkan status, dan sorting.
-   **Admin Panel Fungsional**: Antarmuka visual yang dibangun dengan Filament untuk CRUD Event dan Pengguna.
-   **Registrasi Publik**: Halaman registrasi terpisah untuk para *organizer* baru.

## 🛠️ Teknologi yang Digunakan

-   **Backend**: Laravel 10
-   **Admin Panel**: Filament 3
-   **Database**: PostgreSQL
-   **Otentikasi API**: `tymon/jwt-auth`

## 🚀 Instalasi & Setup

Berikut adalah langkah-langkah untuk menjalankan proyek ini secara lokal.

1.  **Clone Repository**
    ```bash
    git clone https://github.com/ferdiodwi/tefa-backend.git
    cd tefa-backend
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    ```

3.  **Setup Environment**
    Salin file `.env.example` menjadi `.env` dan sesuaikan variabel lingkungan, terutama koneksi database (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
    ```bash
    cp .env.example .env
    ```

4.  **Generate Keys**
    Buat kunci aplikasi dan kunci JWT.
    ```bash
    php artisan key:generate
    php artisan jwt:secret
    ```

5.  **Migrasi dan Seeding Database**
    Perintah ini akan membuat semua tabel database dan mengisinya dengan data awal (1 admin, 2 organizer, dll.).
    ```bash
    php artisan migrate:fresh --seed
    ```

## ධ Jalankan Aplikasi

-   **Jalankan Development Server:**
    ```bash
    php artisan serve
    ```
    Aplikasi akan berjalan di `http://127.0.0.1:8000`.

-   **URL Penting:**
    -   **Base URL API**: `http://127.0.0.1:8000/api`
    -   **Admin Panel**: `http://127.0.0.1:8000/admin`
    -   **Halaman Registrasi Organizer**: `http://127.0.0.1:8000/admin/register`

## 🔑 Akun Demo

Anda bisa menggunakan akun berikut untuk login ke **Admin Panel** setelah menjalankan *seeder*.

-   **Role**: Admin
    -   **Email**: `admin@gmail.com`
    -   **Password**: `admin123`

-   **Role**: Organizer
    -   Anda bisa membuat akun organizer baru melalui halaman `admin/register` atau menggunakan data dari seeder (cek database untuk emailnya).
    -   **Password** untuk semua user dari seeder adalah `password`.

## ⚙️ API Endpoints

Berikut adalah ringkasan dari endpoint API yang tersedia.

| Method   | Endpoint                | Deskripsi                         | Memerlukan Auth |
| :------- | :---------------------- | :-------------------------------- | :-------------- |
| `POST`   | `/api/auth/login`       | Login untuk mendapatkan token     | Tidak           |
| `POST`   | `/api/auth/logout`      | Logout dan membatalkan token      | **Ya** |
| `GET`    | `/api/auth/me`          | Melihat profil user yang login    | **Ya** |
| `GET`    | `/api/events`           | Melihat daftar semua event        | Tidak           |
| `POST`   | `/api/events`           | Membuat event baru                | **Ya** |
| `GET`    | `/api/events/{id}`      | Melihat detail satu event         | Tidak           |
| `PUT`    | `/api/events/{id}`      | Mengupdate data event             | **Ya** |
| `DELETE` | `/api/events/{id}`      | Menghapus event                   | **Ya** |

## 🧪 Pengujian dengan Postman

Sebuah file koleksi Postman (`tefa-test-batch5.postman.json`) sudah disertakan di dalam repository. Anda bisa mengimpornya ke Postman untuk melakukan pengujian ke semua endpoint API dengan lebih mudah.
