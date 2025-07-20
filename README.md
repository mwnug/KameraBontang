# KAMERA BONTANG - Website UMKM Rental Kamera

Website ini dibangun menggunakan PHP Native, Bootstrap 5, dan MySQL. Sistem mendukung:

- Login user dan admin (session-based)
- Admin dapat mengelola katalog kamera, lensa, dan aksesoris
- User dapat melihat katalog dan melakukan pemesanan via WhatsApp
- Dashboard admin menampilkan data katalog dan laporan order
- Tampilan futuristik & mobile-friendly

## Struktur Folder

├── index.php
├── src/
│ ├── css/
│ │ └── style.css
│ ├── js/
│ │ └── order.js
│ ├── img/
│ │ └── (gambar produk)
│ ├── config/
│ │ └── db.php
│ ├── includes/
│ │ ├── header.php
│ │ └── footer.php
│ └── pages/
│ ├── admin/
│ │ ├── dashboard.php
│ │ ├── item_add.php
│ │ ├── item_edit.php
│ │ ├── item_delete.php
│ │ └── orders_report.php
│ ├── user/
│ │ └── catalog.php
│ └── auth/
│ ├── login.php
│ ├── admin_login.php
│ └── logout.php
├── sql/
│ └── database.sql

## Database

Buat database `kamera_bontang`, lalu import file `sql/database.sql`.

## Akun Default (Optional)

- **Admin:** `admin@gmail.com` | `admin123`
- **User:**  `user@gmail.com` | `user123`

## Hosting

Website siap di-upload ke hosting (support PHP ≥ 7.4 dan MySQL ≥ 5.7).

✅ Fitur yang Telah Dibuat:
Sistem login admin & user (dengan sesi)

Halaman katalog & pemesanan via WhatsApp

Admin dapat tambah/edit/hapus produk

Dashboard admin dengan daftar katalog & order

Struktur folder modular: src/pages, config, includes, css, sql, dsb.

Database SQL lengkap dengan relasi antar tabel

Dokumentasi & README siap publish di GitHub

Tampilan futuristik & user-friendly berbasis Bootstrap 5

Siap di-deploy ke hosting berbasis PHP ≥ 7.4 & MySQL ≥ 5.7