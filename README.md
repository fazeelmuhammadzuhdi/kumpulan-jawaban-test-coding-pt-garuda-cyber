## Installation / Instalasi
Direkomendasikan menggunakan php > 8.1.0. Pastikan Repository ini telah diclone, kemudian buka CLI dan posisikan direktori aktif ke repo ini.


### Setup
Jalankan perintah berikut untuk menginstall dependency php
```
composer install
```
Jalankan perintah berikut untuk mengatur _environment variable_
```
cp .env.example .env
```
Pastikan Anda telah membuat database baru di MySQL dan silakan sesuaikan file `.env` dengan database Anda.
Jalankan perintah berikut untuk membuat _key_ untuk web app Anda
```
php artisan key:generate
```
Jalankan perintah berikut untuk menghubungkan folder public Anda dengan storage
```
php artisan storage:link
```
Jalankan perintah berikut untuk membuat skema database dan menjalankan seeder sekaligus
```
php artisan migrate:fresh --seed
```

(Opsional) Jalankan perintah berikut untuk menambahkan data-data _dummy_
```
php artisan db:seed
```
Terakhir, jalankan perintah berikut untuk menjalankan laravel 
```
php artisan serve
```
Setelah perintah di atas dijalankan, web app Anda bisa sudah bisa diakses


## Other / Lainnya
Proyek ini menggunakan admin template [Sneat](https://github.com/themeselection/sneat-html-admin-template-free)

