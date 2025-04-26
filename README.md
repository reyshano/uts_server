Nama : Reyshano Adhyarta Himawan
NIM : A11.2022.13999
Kelas : A11.4601

Project uts yang dibuat adalah aplikasi web sederhana untuk mengelola persediaan barang menggunakan Laravel 12 yang berjalan di Docker.

1. Inisialiasi Project
- Membuka terminal Laragon, lalu menjalankan perintah "composer create-project laravel/laravel uts_server".
- Menyesuaikan isi file .env untuk koneksi dengan database.

2. Containerisasi dengan Docker
- Membuat Dockerfile dan docker-compose.yml yang berisi service untuk aplikasi laravel, database MySql dan phpmyadmin.
- docker-compose up -d --build
- docker compose up -d
- docker-compose exec app bash

3. Analisis Diagram Relasi Database
- Terdiri dari 4 tabel : Admins, Categories, Suppliers, dan Items,
- Membuat migrasi untuk setiap tabel menggunakan perintah "php artisan make:migration namaTabel" dan menyesuaikan dengan skema diagram. (id, name, price, quantity, dll)
= php artisan make:migration create_admins_table
= php artisan make:migration create_categories_table
= php artisan make:migration create_suppliers_table
= php artisan make:migration create_items_table
- Lalu "php artisan migrate"

4. Membuat Model
- Setelah migrasi, membuat model untuk setiap tabel (Admin, Category, Supplier, Item), dengan perintah "php artisan make:model namaModel"
= php artisan make:model Admin
= php artisan make:model Category
= php artisan make:model Supplier
= php artisan make:model Item
- Menambahkan relasi di model supaya tabel tabel dapat terhubung

5. Membuat Admin Seeder
- Membuat admin seeder dengan perintah "php artisan make:seeder AdminSeeder", saya mengisi 2 data admin menggunakan "hash:make" untuk mengenkripsi password
- Menjalankan seeder dengan perintah "php artisan db:seed --class=AdminSeeder"

6. Membuat Dashboard dan Controller
- Dashboard menampilkan ringkasan total items, total categories, dan total suppliers.
- Membuat tombol navigasi ke halaman lain
- php artisan make:controller DashboardController
- php artisan make:controller ItemController
- php artisan make:controller CategoryController
- php artisan make:controller SupplierController
- php artisan make:controller ReportController

7. Membuat View
- Setiap halaman memiliki form untuk tambah data, tabel untuk menampilkan data, dan menyesuaikan route di web.php
- dashboard.blade.php
- category.blade.php
- item.blade.php
- supplier.blade.php

- Fitur Halaman report :
- Menampilkan ringkasan stok barang (total stok, nilai stok, rata-rata harga)
- Daftar barang dengan stok <5 unit
- Laporan barang berdasarkan kategori tertentu
- Ringkasan per kategori dan per supplier
- Ringkasan keseluruhan sistem
- report.blade.php



