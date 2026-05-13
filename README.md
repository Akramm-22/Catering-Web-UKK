# Catering Web UKK

Website catering berbasis Laravel yang dibuat untuk kebutuhan UKK (Uji Kompetensi Keahlian).  
Project ini memiliki fitur pemesanan catering, manajemen menu, autentikasi user, dan dashboard admin.

---

## Features

- Authentication Login & Register
- Dashboard Admin
- CRUD Menu Catering
- Pemesanan Catering
- Manajemen Data User
- Responsive UI
- Export Data

---

## Tech Stack

- PHP
- Laravel
- MySQL
- Bootstrap / Tailwind CSS
- JavaScript

---

## Installation

Clone repository:

```bash
git clone https://github.com/Akramm-22/Catering-Web-UKK.git
```

Masuk ke folder project:

```bash
cd Catering-Web-UKK
```

Install dependency:

```bash
composer install
```

Copy file environment:

```bash
cp .env.example .env
```

Generate key:

```bash
php artisan key:generate
```

Atur database di file `.env`

Lalu jalankan migration:

```bash
php artisan migrate
```

Jalankan server:

```bash
php artisan serve
```

---

## Default URL

```txt
http://127.0.0.1:8000
```

---

## Author

Akram Raton

---

## License

Project ini dibuat untuk kebutuhan pembelajaran dan UKK.
