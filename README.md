# Book Management API - Simple CRUD Laravel

Ini adalah proyek API sederhana yang dibangun menggunakan Laravel untuk manajemen data buku. Proyek ini dibuat sebagai bagian dari tes teknis dan mencakup fungsionalitas dasar Create, Read, Update, Delete (CRUD) serta fitur pencarian dan validasi.

API ini mengikuti standar REST dan dirancang untuk menjadi backend bagi aplikasi frontend seperti web (JavaScript) atau mobile.

## Fitur Utama
- **Create**: Menambahkan buku baru ke dalam database.
- **Read**: Menampilkan daftar buku dengan paginasi (4 buku per halaman).
- **Update**: Memperbarui deskripsi (sinopsis) dari buku yang sudah ada.
- **Delete**: Menghapus data buku dari database.
- **Search**: Mencari buku berdasarkan nama atau deskripsi.
- **Validation**: Memastikan integritas data, seperti mencegah duplikasi buku dengan penulis yang sama dan membatasi panjang input.

## Persyaratan
- PHP >= 8.1
- Composer
- Web Server Lokal (XAMPP, Laragon, dll.)
- Database (MySQL/MariaDB)

## Instalasi & Penggunaan
Berikut adalah langkah-langkah untuk menjalankan proyek ini di lingkungan lokal.

### 1. Clone Repositori
Clone repositori ini ke komputermu:
```bash
git clone https://github.com/barnimd/Technical-Test-Backend-Ngontenin.git
cd nama-folder-proyek
```

### 2. Instal Dependensi
Instal semua dependensi PHP yang dibutuhkan menggunakan Composer:
```bash
composer install
```

### 3. Konfigurasi Lingkungan
Salin file `.env.example` menjadi `.env`:
```bash
copy .env.example .env
```
Buka file `.env` dan sesuaikan konfigurasi database (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) dengan pengaturan di komputer.

### 4. Buat Kunci Aplikasi
Generate kunci aplikasi unik untuk proyek Laravel:
```bash
php artisan key:generate
```

### 5. Jalankan Migrasi & Seeder
Buat semua tabel yang dibutuhkan dan isi dengan data awal menggunakan perintah berikut:
```bash
php artisan migrate:fresh --seed
```
Perintah ini akan membuat tabel `users`, `books`, dll., dan mengisi tabel `books` dengan beberapa data contoh.

### 6. Jalankan Server
Nyalakan server development Laravel:
```bash
php artisan serve
```
API sekarang akan berjalan dan dapat diakses di `http://127.0.0.1:8000`.

## Panduan Endpoint API
Gunakan API client seperti Postman untuk berinteraksi dengan endpoint berikut.

---

### 1. List Books
Menampilkan daftar buku dengan paginasi.

- **Method**: `GET`
- **URL**: `/api/books`
- **Contoh URL Halaman 2**: `/api/books?page=2`
- **Respons Sukses (200 OK)**:
  ```json
  {
      "current_page": 1,
      "data": [
          {
              "id": 1,
              "book_name": "Laskar Pelangi",
              "description": "...",
              "author": "Andrea Hirata",
              "published_date": "2005-09-01",
              "created_at": "...",
              "updated_at": "..."
          }
      ],
      "next_page_url": "...",
      "path": "...",
      "per_page": 4,
      ...
  }
  ```

---

### 2. Create Book
Menambahkan buku baru.

- **Method**: `POST`
- **URL**: `/api/books`
- **Body** (raw, JSON):
  ```json
  {
      "book_name": "Buku Baru",
      "author": "Penulis Baru",
      "description": "Deskripsi singkat buku baru.",
      "published_date": "2025-01-01"
  }
  ```
- **Respons Sukses (201 Created)**:
  ```json
  {
      "message": "Book created successfully",
      "data": { ... }
  }
  ```

---

### 3. Update Book
Memperbarui deskripsi buku.

- **Method**: `PUT` atau `PATCH`
- **URL**: `/api/books/{id}` (Contoh: `/api/books/1`)
- **Body** (raw, JSON):
  ```json
  {
      "description": "Ini adalah deskripsi yang sudah diperbarui."
  }
  ```
- **Respons Sukses (200 OK)**:
  ```json
  {
      "message": "Book updated successfully",
      "data": { ... }
  }
  ```
  
---

### 4. Delete Book
Menghapus buku.

- **Method**: `DELETE`
- **URL**: `/api/books/{id}` (Contoh: `/api/books/1`)
- **Respons Sukses (200 OK)**:
  ```json
  {
      "message": "Book deleted successfully"
  }
  ```

---

### 5. Search Book
Mencari buku berdasarkan nama atau deskripsi.

- **Method**: `GET`
- **URL**: `/api/books/search`
- **Query Params**:
  - `key`: `query`
  - `value`: `kata-kunci-pencarian`
- **Contoh URL**: `/api/books/search?query=pelangi`
- **Respons Sukses (200 OK)**:
  Struktur responsnya sama seperti **List Books**, tetapi `data` hanya berisi buku yang cocok dengan kriteria pencarian.
