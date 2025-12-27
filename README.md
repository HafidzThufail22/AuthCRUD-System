# 🏙️ AuthCRUD System - Sistem Manajemen Data Kota

Aplikasi web untuk manajemen data kota dengan fitur autentikasi menggunakan **Laravel 12 (Backend API)** dan **PHP Native (Frontend)**.

---

## 📋 Deskripsi

AuthCRUD System adalah aplikasi CRUD (Create, Read, Update, Delete) untuk mengelola data kota di Indonesia. Aplikasi ini memiliki sistem autentikasi berbasis token menggunakan Laravel Sanctum.

### Fitur Utama:

- 🔐 **Autentikasi** - Register, Login, dan Logout dengan token-based authentication
- 📝 **CRUD Kota** - Tambah, Lihat, Edit, dan Hapus data kota
- 🏛️ **Data Propinsi** - Relasi data kota dengan propinsi
- 🔑 **API Protected** - Endpoint dilindungi dengan token Sanctum

---

## 🛠️ Tech Stack

| Layer              | Teknologi             |
| ------------------ | --------------------- |
| **Backend**        | Laravel 12, PHP 8.2+  |
| **Frontend**       | PHP Native, HTML, CSS |
| **Authentication** | Laravel Sanctum       |
| **Database**       | MySQL / SQLite        |

---

## 📁 Struktur Project

```
AuthCRUD System/
├── backend/                 # Laravel 12 API
│   ├── app/
│   │   ├── Http/
│   │   │   └── Controllers/
│   │   │       └── Api/
│   │   │           ├── AuthController.php
│   │   │           ├── KotaController.php
│   │   │           └── PropinsiController.php
│   │   └── Models/
│   │       ├── User.php
│   │       ├── Kota.php
│   │       └── Propinsi.php
│   ├── database/
│   │   ├── migrations/
│   │   └── seeders/
│   └── routes/
│       └── api.php
│
├── frontend/                # PHP Native Frontend
│   ├── login.php           # Halaman login
│   ├── register.php        # Halaman registrasi
│   ├── logout.php          # Proses logout
│   ├── tampil_kota.php     # Menampilkan daftar kota
│   ├── tambah_kota.php     # Form tambah kota
│   ├── edit_kota.php       # Form edit kota
│   └── hapus_kota.php      # Proses hapus kota
│
└── README.md
```

---

## ⚙️ Instalasi

### Prasyarat

- PHP >= 8.2
- Composer
- MySQL/MariaDB atau SQLite
- Web Server (Apache/XAMPP/Laragon)

### Langkah Instalasi

#### 1. Clone Repository

```bash
git clone <repository-url>
cd "AuthCRUD System"
```

#### 2. Setup Backend (Laravel)

```bash
cd backend

# Install dependencies
composer install

# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate

# Konfigurasi database di file .env
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=authcrud_db
# DB_USERNAME=root
# DB_PASSWORD=

# Jalankan migrasi database
php artisan migrate

# (Opsional) Jalankan seeder
php artisan db:seed
```

#### 3. Jalankan Server Backend

```bash
php artisan serve
# Server berjalan di http://127.0.0.1:8000
```

#### 4. Setup Frontend

Tempatkan folder `frontend/` di direktori web server (htdocs/www), atau gunakan PHP built-in server:

```bash
cd frontend
php -S localhost:8080
# Akses di http://localhost:8080
```

---

## 🔌 API Endpoints

### Public Routes (Tanpa Token)

| Method | Endpoint          | Deskripsi                |
| ------ | ----------------- | ------------------------ |
| `POST` | `/api/register`   | Registrasi user baru     |
| `POST` | `/api/auth/login` | Login dan dapatkan token |

### Protected Routes (Memerlukan Token)

| Method   | Endpoint         | Deskripsi             |
| -------- | ---------------- | --------------------- |
| `POST`   | `/api/logout`    | Logout user           |
| `GET`    | `/api/kota`      | Ambil semua data kota |
| `POST`   | `/api/kota`      | Tambah kota baru      |
| `GET`    | `/api/kota/{id}` | Ambil detail kota     |
| `PUT`    | `/api/kota/{id}` | Update data kota      |
| `DELETE` | `/api/kota/{id}` | Hapus kota            |
| `GET`    | `/api/propinsi`  | Ambil data propinsi   |

### Contoh Request dengan Token

```bash
# Header Authorization
Authorization: Bearer {your-token}
```

---

## 💾 Database Schema

### Tabel `users`

| Column     | Type   | Description            |
| ---------- | ------ | ---------------------- |
| id         | bigint | Primary key            |
| name       | string | Nama user              |
| email      | string | Email (unique)         |
| password   | string | Password (hashed)      |
| timestamps | -      | created_at, updated_at |

### Tabel `kotas`

| Column      | Type    | Description             |
| ----------- | ------- | ----------------------- |
| id          | bigint  | Primary key             |
| nama_kota   | string  | Nama kota               |
| propinsi_id | integer | Foreign key ke propinsi |
| timestamps  | -       | created_at, updated_at  |

### Tabel `propinsis`

| Column        | Type   | Description            |
| ------------- | ------ | ---------------------- |
| id            | bigint | Primary key            |
| nama_propinsi | string | Nama propinsi          |
| timestamps    | -      | created_at, updated_at |

---

## 🚀 Cara Penggunaan

1. **Register** - Buat akun baru di halaman registrasi
2. **Login** - Masuk dengan email dan password
3. **Kelola Data Kota**:
   - Lihat daftar kota di halaman utama
   - Tambah kota baru dengan klik "Tambah Kota"
   - Edit kota dengan klik tombol "Edit"
   - Hapus kota dengan klik tombol "Hapus"
4. **Logout** - Keluar dari sistem

---

## 📝 Catatan Pengembangan

- Frontend menggunakan **cURL** untuk komunikasi dengan API Laravel
- Token disimpan di **PHP Session** setelah login berhasil
- Semua endpoint CRUD dilindungi dengan middleware `auth:sanctum`

---

## 👨‍💻 Author

**Thufail Hafidz**

- Email: thufailhafidz22@gmail.com

---

## 📄 Lisensi

Project ini dibuat untuk keperluan akademik - **Tugas Mata Kuliah Framework Web Semester 5**

---

## 🙏 Terima Kasih

Terima kasih telah menggunakan AuthCRUD System! 🎉
