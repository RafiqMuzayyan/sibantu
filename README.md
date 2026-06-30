## 🚀 Instalasi

### Clone Repository

```bash
git clone https://github.com/USERNAME/sibantu.git
cd sibantu
```

### Install Dependency

```bash
composer install
npm install
```

### Setup Environment

Salin file konfigurasi environment, kemudian generate application key.

```bash
cp .env.example .env
php artisan key:generate
```

### Konfigurasi Database

Sesuaikan konfigurasi database pada file `.env`.

```env
DB_DATABASE=sibantu
DB_USERNAME=root
DB_PASSWORD=
```

### Migrasi Database dan Seeder

```bash
php artisan migrate --seed
```

### Membuat Symbolic Link Storage

Agar file yang diunggah pengguna (seperti bukti aduan) dapat diakses melalui browser, jalankan:

```bash
php artisan storage:link
```

### Build Asset Frontend

Untuk mode development:

```bash
npm run dev
```

Untuk mode production:

```bash
npm run build
```

### Menjalankan Server

```bash
php artisan serve
```