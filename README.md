# SI XXI – Sistem Informasi Katalog Film

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/Database-MySQL-4479A1?style=flat&logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green.svg)

**SI XXI** adalah aplikasi web berbasis Laravel untuk mengelola katalog film dan trailer. Aplikasi ini menyediakan landing page publik dengan mode terang/gelap, pencarian dan filter film, sistem favorit, riwayat tontonan trailer, halaman profil **My m.tix** untuk pengguna, serta dashboard admin untuk mengelola film, genre, pengguna, dan log aktivitas.

## Daftar Isi

- [Fitur Utama](#fitur-utama)
- [Tech Stack](#tech-stack)
- [Persyaratan Sistem](#persyaratan-sistem)
- [Instalasi](#instalasi)
- [Konfigurasi](#konfigurasi)
- [Role & Permissions](#role--permissions)
- [Fitur Berdasarkan Role](#fitur-berdasarkan-role)
- [Activity Log](#activity-log)
- [Screenshot](#screenshot)
- [Struktur Database](#struktur-database)
- [Penggunaan](#penggunaan)
- [Deployment](#deployment)
- [Kontribusi](#kontribusi)
- [Lisensi](#lisensi)

## Fitur Utama

### Landing Page & Eksplorasi Film

- ✅ **Landing Page Publik** – Dapat diakses semua orang tanpa login.
- ✅ **Dark Mode & Light Mode** – Toggle tema gelap/terang yang konsisten di seluruh halaman.
- ✅ **Browse by Genre** – Shortcut kartu genre (Horror, Sci-Fi, Romance, dll.).
- ✅ **Section Daftar Film** – Menampilkan film yang sedang tayang dalam bentuk kartu.
- ✅ **Search Bar Global** – Pencarian film berdasarkan judul atau cinema.
- ✅ **Halaman See All** – Daftar film lengkap dengan filter judul, genre, dan tahun rilis.

### Detail Film & Favorit

- ✅ **Halaman Detail Film** – Menampilkan poster, judul, genre, tahun, sutradara, durasi, dan sinopsis.
- ✅ **Trailer & Riwayat Tontonan** – Akses trailer/preview film sekaligus tercatat di riwayat user.
- ✅ **Tambah ke Favorit** – User yang login dapat menyukai film dari kartu maupun halaman detail.
- ✅ **Popup Login Diperlukan** – Jika guest mencoba menyukai film, muncul modal yang meminta login dulu.

### My m.tix (User Dashboard)

- ✅ **Profil My m.tix** – Menampilkan nama dan informasi kontak singkat pengguna.
- ✅ **Ganti Password** – Form untuk mengubah password (password saat ini, password baru, konfirmasi).
- ✅ **Daftar Film Favorit** – Menampilkan semua film yang disukai; bisa hapus dari favorit dan buka detail.
- ✅ **Riwayat Tontonan Trailer** – List film yang pernah ditonton/diakses trailernya beserta timestamp dan aksi cepat tambah/hapus favorit.

### Dashboard Admin

- ✅ **Dashboard Statistik** – Ringkasan total film, total genre, dan total pengguna.
- ✅ **Kelola Film** – CRUD film (tambah, edit, hapus) yang akan tampil di landing page dan halaman user.
- ✅ **Kelola Genre** – CRUD genre beserta deskripsi dan thumbnail.
- ✅ **Kelola Pengguna** – Tambah user, atur role (User/Admin), dan hapus user dengan proteksi self-delete.
- ✅ **Log Aktivitas Pengguna** – Riwayat aksi seperti login, register, buka detail film, update film, dan interaksi lainnya.

### Fitur Modern

- ✅ **Responsive Design** – Desain responsif yang nyaman di desktop dan mobile.
- ✅ **Role Based Access Control** – Pemisahan hak akses Guest, User, dan Admin.
- ✅ **Clean UI** – Tampilan terinspirasi dashboard modern dengan card dan icon yang konsisten.

## Tech Stack


### Backend
- **Laravel 12.0** – PHP framework utama untuk pengembangan aplikasi.
- **Laravel Sanctum 4.2.1** – API authentication dan token-based auth untuk SPA/mobile.
- **Laravel Tinker 2.10.2** – Interactive shell untuk eksekusi kode Laravel secara langsung.
- **Laravel UI 4.6.1** – Scaffolding autentikasi (login, register, reset password).
- **Firebase PHP-JWT 6.11.1** – Implementasi JSON Web Token (JWT) untuk autentikasi.
- **MySQL** – Database utama (dikontrol melalui konfigurasi `config/database.php`).


### Frontend
- **Tailwind CSS 3.4.13** – Utility-first CSS framework dengan dukungan dark mode.
- **Bootstrap 5.2.3** – CSS framework untuk komponen UI dan layout.
- **Alpine.js 3.x.x** – JavaScript framework ringan untuk interaksi reaktif (via CDN di layout).
- **Sass 1.56.1** – CSS preprocessor untuk struktur stylesheet yang lebih rapi.
- **Axios 1.11.0** – HTTP client untuk permintaan API dari sisi frontend.


### Libraries & Packages
- **Guzzle HTTP 7.10.0** – HTTP client untuk konsumsi API dari sisi backend.
- **PHPUnit 11.5.3** – Testing framework untuk unit dan feature test.
- **Mockery 1.6** – Library mock object untuk pengujian.
- **NunoMaduro Collision 8.6** – Error handler untuk perintah console.
- **Laravel Pint 1.24** – Code style fixer untuk menjaga konsistensi format PHP.
- **Laravel Pail 1.2.2** – Pembaca log Laravel dari CLI.
- **FakerPHP/Faker 1.23** – Generator data palsu untuk kebutuhan testing dan seeding.


### Build Tools & Development
- **Vite 7.0.7** – Build tool dan dev server untuk asset bundling.
- **Laravel Vite Plugin 2.0.0** – Integrasi Vite dengan Laravel.
- **Autoprefixer 10.4.22** – Penambahan vendor prefix CSS otomatis.
- **PostCSS 8.5.6** – Alat pemrosesan CSS (pipeline Tailwind/Sass).
- **Concurrently 9.0.1** – Menjalankan beberapa perintah development secara paralel.
- **Laravel Sail 1.41** – Lingkungan pengembangan berbasis Docker untuk Laravel.


### Additional Notes
- **Database Schema**: Terdapat file schema PostgreSQL, namun konfigurasi runtime menggunakan **MySQL**.
- **Authentication**: Menggunakan kombinasi **Laravel Sanctum** dan **JWT** (Firebase PHP-JWT).
- **Testing**: Mengandalkan **PHPUnit**, **Mockery**, dan **FakerPHP** untuk pengujian otomatis.
- **Styling**: Kombinasi **Tailwind CSS** (termasuk dark mode) dan **Bootstrap** untuk komponen.
- **JavaScript**: **Alpine.js** digunakan untuk behavior reaktif di komponen front-end.


## Persyaratan Sistem


- PHP >= 8.2  
- MySQL >= 5.7 atau MariaDB >= 10.3  
- Composer  
- Node.js & NPM  
- Web Server (Apache/Nginx)  

- Extension PHP yang dibutuhkan:
  - bz2
  - curl
  - fileinfo
  - exif
  - mysqli
  - pdo_mysql
  - pdo_pgsql
  - pdo_sqlite
  - pgsql
  - zip


## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/aidilsaputrakirsan-classroom/final-project-cloud-computing-b-cc-kelompok-5-framline.git
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3. Setup Environment

```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=pgsql
DB_URL=postgresql://postgres.jcwrejgisfxjcaorpjvn:tQC8bt0edPfQ2X55@aws-1-ap-southeast-1.pooler.supabase.com:5432/postgres
```

### 5. Migrasi Database

```bash
# Jalankan migrasi dan seeder
php artisan migrate --seed

# Atau jika ingin fresh install
php artisan migrate:fresh --seed
```

### 6. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 9. Jalankan Aplikasi

```bash
# Development server
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## Konfigurasi

### Email Configuration

Edit konfigurasi email di file `.env`:

```env
MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### File Storage

Untuk menggunakan AWS S3 storage, konfigurasi:

```env
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false
```

## Role & Permissions

Sistem menggunakan 3 role utama:

| Role      | Deskripsi                                                |
|-----------|----------------------------------------------------------|
| **Guest** | Pengunjung tanpa login, hanya bisa eksplorasi & lihat.  |
| **User**  | Pengguna terdaftar dengan akses My m.tix & favorit.     |
| **Admin** | Pengelola sistem dengan akses penuh dashboard admin.    |

## Fitur Berdasarkan Role

### Guest

- 🔍 Melihat landing page, Daftar Film, dan Browse by Genre.
- 🎬 Melihat detail film dan trailer.
- 🔎 Menggunakan search dan filter.
- 🚫 Tidak dapat menyimpan favorit atau mengakses My m.tix.

### User

- ✅ Semua fitur Guest.
- ❤️ Menambah dan menghapus film dari daftar favorit.
- 🎫 Mengakses **My m.tix**:
  - Mengelola profil dasar.
  - Mengubah password.
  - Melihat & mengelola daftar film favorit.
  - Melihat riwayat tontonan trailer.
- 🔐 Dapat **login** dan **logout** kapan saja.

### Admin

- ✅ Semua fitur User.
- 🎬 **Kelola Film** – CRUD data film yang tampil ke publik.
- 🏷️ **Kelola Genre** – CRUD genre dan deskripsinya.
- 👥 **Kelola Pengguna** – Tambah user, atur role, hapus user (kecuali diri sendiri).
- 📜 **Log Aktivitas Pengguna** – Monitoring interaksi user dengan sistem.

## Activity Log

Sistem mencatat aktivitas penting untuk keperluan audit sederhana:

- Register dan login user.
- Membuka detail film.
- Menambah/menghapus favorit.
- CRUD film dan genre oleh admin.
- Perubahan role atau penghapusan user.

Log biasanya berisi:

- Nama user.
- Jenis aksi (action).
- Waktu (timestamp).
- Detail singkat (judul film, dsb.).

## Screenshot


### 1. Landing Page (Guest)
![Landing Page Guest](screenshots/01-landing-page.png)
*Landing page SI XXI dengan hero banner, tombol pencarian, serta daftar genre dan section Daftar Film yang dapat diakses tanpa login.*


### 2. Landing Page – See All Film
![Daftar Film (See All)](screenshots/02-daftar-film.png)
*Halaman daftar film lengkap dengan fitur pencarian dan filter berdasarkan judul, genre, dan tahun rilis.*


### 3. Detail Film & Popup Login Diperlukan
![Detail Film & Popup Login](screenshots/03-detail-film-login-required.png)
*Halaman detail film dengan informasi lengkap dan popup yang muncul ketika guest mencoba menambahkan film ke favorit.*


### 4. Dashboard Admin
![Dashboard Admin](screenshots/04-dashboard-admin.png)
*Dashboard admin dengan statistik total film, total genre, dan total pengguna, serta shortcut ke halaman manajemen konten.*


### 5. Kelola Film
![Kelola Film](screenshots/05-kelola-film.png)
*Halaman manajemen film yang menampilkan daftar film dan aksi tambah, edit, serta hapus.*


### 6. Kelola Genre
![Kelola Genre](screenshots/06-kelola-genre.png)
*Halaman pengelolaan genre film dengan kartu genre, deskripsi singkat, serta tombol edit dan hapus.*


### 7. Kelola Pengguna
![Kelola Pengguna](screenshots/07-kelola-pengguna.png)
*Halaman manajemen pengguna yang memungkinkan admin menambah user baru, mengatur role, dan menghapus pengguna tertentu.*


### 8. Log Aktivitas Pengguna
![Log Aktivitas Pengguna](screenshots/08-log-aktivitas.png)
*Halaman log aktivitas yang menampilkan riwayat aksi pengguna seperti login, register, membuka detail film, dan pembaruan data.*


### 9. My m.tix – Profil
![My m.tix Profil](screenshots/09-my-mtix.png)
*Halaman My m.tix yang menampilkan profil singkat pengguna serta menu pengaturan dan aktivitas.*


### 10. My m.tix – Ganti Password
![My m.tix Ganti Password](screenshots/10-my-mtix-change-password.png)
*Form untuk mengubah password akun yang berisi field password saat ini, password baru, dan konfirmasi password baru.*


### 11. My m.tix – Riwayat Tontonan
![My m.tix Riwayat Tontonan](screenshots/11-my-mtix-watch-history.png)
*Halaman riwayat tontonan trailer yang menampilkan daftar film yang pernah ditonton beserta tanggal dan waktu.*


### 12. My m.tix – Film Favorit Saya
![My m.tix Film Favorit](screenshots/12-my-mtix-favorites.png)
*Halaman daftar film favorit pengguna yang menampilkan kartu film beserta tombol lihat detail dan hapus dari favorit.*


## Struktur Database


### Tabel Utama

- **users** – Data pengguna sistem (admin dan user) beserta informasi profil dasar.
- **roles** – Data role pengguna (misalnya: admin, user).
- **films** – Data film (judul, sinopsis, tahun rilis, sutradara, durasi, poster, trailer URL, dll.).
- **genres** – Data genre film (nama, deskripsi, gambar).
- **film_genre** – Tabel pivot relasi many-to-many antara films dan genres.
- **film_user_favorites** – Data film favorit milik user (daftar like/favorit).
- **film_user_history** – Riwayat tontonan trailer/detail film oleh user.
- **audit_logs** – Log aktivitas pengguna terkait film (open detail, update, dll.).
- **sessions** – Data session login pengguna.
- **cache** – Cache aplikasi.
- **cache_locks** – Lock untuk operasi cache.
- **migrations** – Riwayat migrasi database Laravel.
- **password_resets** – Token reset password pengguna.


### Relasi Database

```
users (1) ─── (n) film_user_favorites
films (1) ─── (n) film_user_favorites

users (1) ─── (n) film_user_history
films (1) ─── (n) film_user_history

users (1) ─── (n) audit_logs
films (1) ─── (n) audit_logs

roles (1) ─── (n) users

films (1) ─── (n) film_genre
genres (1) ─── (n) film_genre
```

## Arsitektur & Komponen

### Arsitektur Aplikasi


Aplikasi ini menggunakan arsitektur **Laravel monolith** dengan pemisahan yang jelas antara layer presentasi, bisnis, dan data untuk mendukung fitur katalog film, My m.tix, dan dashboard admin.


- **Controllers** – Mengelola routing dan business logic utama (landing page, My m.tix, serta modul admin seperti kelola film, genre, pengguna, dan log aktivitas).

- **Models** – Eloquent ORM models untuk entitas inti seperti `User`, `Role`, `Film`, `Genre`, `FilmUserFavorite`, `FilmUserHistory`, dan `AuditLog` dengan relasi one-to-many serta many-to-many.

- **Form Requests/Validation Layer** – Menangani validasi input (auth, tambah film, update profil, ganti password, dll.) agar data yang masuk ke sistem tetap konsisten.

- **Services/Helpers** – Kelas atau helper terpisah (misalnya untuk pengelolaan file poster, logging aktivitas, serta pengolahan riwayat tontonan) sehingga logic tidak menumpuk di controller.

- **Middleware** – Mengatur akses berdasarkan role (Guest, User, Admin), termasuk proteksi route admin, My m.tix, dan fitur favorit.

- **Blade Layouts & Components** – Struktur tampilan berbasis layout utama dengan komponen Blade untuk elemen berulang seperti navbar, kartu film, kartu genre, dan komponen dashboard.

- **Database Layer (Migrations & Seeders)** – Mengelola struktur tabel (users, roles, films, genres, film_genre, film_user_favorites, film_user_history, audit_logs, dll.) beserta data awal untuk pengujian dan demo.

### Fitur Teknis Unggulan

- **Landing Page Public + Dark/Light Mode** - Landing page dapat diakses tanpa login dengan dukungan tema terang dan gelap yang konsisten.
- **Advanced Film Browsing & Search** - Pencarian dan filter film berdasarkan judul, genre, dan tahun melalui search bar dan halaman “See All”.
- **Favorite & Watch History System** - Sistem penyimpanan film favorit dan pencatatan otomatis riwayat tontonan trailer untuk setiap user yang login.
- **My m.tix User Area** - Halaman khusus pengguna untuk mengelola profil, mengganti password, melihat daftar film favorit, dan riwayat tontonan.
- **Role-based Access Control** - Pemisahan hak akses antara Guest, User, dan Admin untuk menjaga keamanan dan otorisasi fitur.
- **Admin Content Management** - Modul manajemen film, genre, dan pengguna (CRUD) yang mengontrol konten di landing page dan halaman user.
- **Audit & Activity Logging** - Pencatatan aktivitas penting seperti login, buka detail film, dan update data pada log aktivitas pengguna.
- **Responsive Mobile-First** - Tampilan antarmuka yang dirancang mobile-first dan responsif di berbagai ukuran layar.

## Testing

### Test Framework

Aplikasi dilengkapi dengan **PHPUnit 11.5.3** untuk unit dan feature testing, dengan dukungan Mockery dan FakerPHP untuk kebutuhan mock dan data palsu.

```bash
# Jalankan semua tests
php artisan test

# Jalankan dengan coverage
php artisan test --coverage

# Jalankan test spesifik
php artisan test --filter=NamaTest
```

### Konfigurasi Test


- **Test Database**: Biasanya menggunakan SQLite in-memory atau database testing terpisah (MySQL) yang dikonfigurasi di `phpunit.xml`.
- **Test Suites**: Unit tests dan Feature tests yang mencakup autentikasi, manajemen film, genre, favorit, dan log aktivitas.
- **Mock Services**: Layanan eksternal (HTTP, mail, queue) dapat dimock menggunakan **Mockery** dan driver array/sync.
- **Coverage**: Dapat diaktifkan untuk memantau kualitas dan cakupan kode menggunakan perintah `php artisan test --coverage`.

## Penggunaan


### Login Pertama Kali

Setelah instalasi dan seeding database, Anda dapat login menggunakan akun default yang dibuat oleh seeder.  
Silakan periksa file `/database/seeders/UserSeeder.php` atau dokumentasi internal proyek untuk melihat email dan password default yang tersedia.

> Disarankan untuk segera mengubah password akun default setelah berhasil login pertama kali.


### Workflow Umum Aplikasi

1. **Admin** login menggunakan akun admin bawaan.
2. **Admin** menambahkan atau mengatur data **genre film** pada menu *Kelola Genre*.
3. **Admin** menambahkan data **film** pada menu *Kelola Film* (judul, tahun, genre, poster, sinopsis, dll.).
4. **Admin** dapat menambahkan **pengguna baru** atau memberikan role admin/user pada menu *Kelola Pengguna* bila diperlukan.
5. **Guest** (pengunjung tanpa login) mengakses landing page, menjelajah film melalui *Daftar Film*, *Browse by Genre*, atau fitur pencarian.
6. Ketika guest ingin menambahkan film ke favorit, muncul popup **Login Diperlukan**, lalu:
   - Guest melakukan **register** untuk membuat akun baru, atau
   - Guest melakukan **login** jika sudah memiliki akun.
7. **User** yang sudah login dapat:
   - Menelusuri film pada landing page dan halaman *See All*.
   - Membuka detail film dan menambahkan film ke **daftar favorit**.
   - Menonton trailer/detail film yang otomatis tercatat di **riwayat tontonan**.
8. **User** mengelola akun melalui halaman **My m.tix**:
   - Mengubah password pada menu *Ganti Password*.
   - Melihat dan menghapus film pada menu *Daftar Film Favorit*.
   - Melihat histori di menu *Riwayat Tontonan*.
9. **Admin** memantau interaksi pengguna melalui menu **Log Aktivitas Pengguna** (login, buka film, update data, dan lain‑lain).
10. **User** maupun **Admin** dapat melakukan **logout** kapan saja untuk mengakhiri sesi dan kembali ke halaman publik.


## Deployment


### Requirements Production

- PHP 8.2 atau lebih tinggi
- MySQL/MariaDB
- Composer
- Node.js & NPM
- Web server (Apache/Nginx) dengan SSL certificate
- Ekstensi PHP sesuai daftar pada bagian *Persyaratan Sistem*


### Production Setup

1. Clone repository ke server (via Git atau upload).
2. Install dependencies PHP dan JavaScript.
3. Setup environment untuk production (`.env`).
4. Jalankan migrasi dan seeding jika diperlukan.
5. Build asset frontend dengan Vite.
6. Optimize aplikasi Laravel:

```bash
# Install PHP dependencies tanpa dev
composer install --optimize-autoloader --no-dev

# Install dan build frontend assets
npm install
npm run build

# Generate application key (jika belum)
php artisan key:generate

# Jalankan migrasi database
php artisan migrate --force

# Optimize configuration
php artisan config:cache

# Optimize routes
php artisan route:cache

# Optimize views
php artisan view:cache
```

7. Setup cron job untuk scheduled tasks:

```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

8. Setup queue worker (optional):

```bash
php artisan queue:work --daemon
```

9. Pastikan virtual host/server block mengarah ke direktori `public` dan SSL sudah aktif.

### GitHub Actions

Project ini sudah dilengkapi dengan GitHub Actions untuk auto-deployment. Konfigurasi dapat dilihat di `.github/workflows/deploy.yml`.

## Kontribusi

Kontribusi selalu diterima! Silakan ikuti langkah berikut:

1. Fork repository ini
2. Buat branch fitur baru (`git checkout -b feature/activity_log`)
3. Commit perubahan (`git commit -m 'Add some Feature'`)
4. Push ke branch (`git push origin feature/activity_log`)
5. Buat Pull Request

### Coding Standards

- Ikuti PSR-12 coding standard
- Gunakan meaningful variable dan function names
- Tambahkan komentar untuk logika yang kompleks
- Write clean dan maintainable code

## Lisensi

Project ini dilisensikan di bawah [MIT License](LICENSE).

## Credits

- **Laravel Framework** - [https://laravel.com](https://laravel.com)

## Support

Jika ada pertanyaan atau issues, silakan:
- Buat issue di GitHub repository
- Hubungi tim development

---

**Developed with ❤️ for Sistem Informasi Institut Teknologi Kalimantan**

*Last updated: Desember 2025*
