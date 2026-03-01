# 🛍️ VinShop - E-Commerce Web App

VinShop adalah aplikasi web e-commerce yang dibangun menggunakan **Laravel 12** dengan fitur lengkap mulai dari manajemen produk, keranjang belanja, checkout, hingga integrasi pembayaran via **Midtrans**.

🌐 **Live Demo:** [https://vinshop-production.up.railway.app](https://vinshop-production.up.railway.app)

---

## 🚀 Teknologi yang Digunakan

- **Laravel 12** - PHP Framework
- **Laravel Breeze** - Authentication
- **MySQL** - Database
- **Tailwind CSS** - Styling (CDN)
- **Midtrans** - Payment Gateway (Sandbox)
- **Railway** - Cloud Hosting
- **XAMPP** - Local Development Server

---

## ✨ Fitur

### 👤 Customer
- Register & Login
- Browse produk dengan filter kategori dan pencarian
- Halaman detail produk dengan foto gallery dan produk terkait
- Keranjang belanja (tambah, update quantity, hapus)
- Checkout dengan pilihan alamat pengiriman dan metode pembayaran
- Pembayaran via Midtrans (QRIS, Transfer Bank, E-Wallet, GoPay)
- Riwayat pesanan beserta status pengiriman dan pembayaran
- Edit profile (nama, email, nomor HP, alamat, foto profil)
- Ganti password

### 🔧 Admin
- Dashboard statistik (total customer, produk, order, revenue)
- Kelola kategori (CRUD + support sub-kategori)
- Kelola produk (CRUD + upload foto utama & foto tambahan)
- Kelola pesanan (update status pengiriman & pembayaran)

---

## 🗂️ Struktur Database

```
users ──< orders ──< order_items >── products
users ──< carts  >── products
orders ──< payments
products >── categories
products ──< product_images
```

### Tabel Utama
| Tabel | Keterangan |
|---|---|
| `users` | Data user dengan role admin/customer, foto profil (avatar) |
| `categories` | Kategori produk dengan support sub-kategori |
| `products` | Data produk |
| `product_images` | Foto tambahan produk |
| `carts` | Keranjang belanja user |
| `orders` | Data pesanan |
| `order_items` | Item dalam pesanan (snapshot harga) |
| `payments` | Data pembayaran + snap_token Midtrans |

---

## 📁 Struktur Project

```
vinshop/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── AdminProductController.php
│   │   │   │   ├── AdminCategoryController.php
│   │   │   │   └── AdminOrderController.php
│   │   │   ├── CartController.php
│   │   │   ├── HomeController.php
│   │   │   ├── OrderController.php
│   │   │   ├── PaymentController.php
│   │   │   ├── ProductController.php
│   │   │   └── ProfileController.php
│   │   ├── Middleware/
│   │   │   └── IsAdmin.php
│   │   └── Requests/
│   │       └── ProfileUpdateRequest.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Category.php
│   │   ├── Product.php
│   │   ├── ProductImage.php
│   │   ├── Cart.php
│   │   ├── Order.php
│   │   ├── OrderItem.php
│   │   └── Payment.php
│   └── Providers/
│       └── AppServiceProvider.php
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── UserSeeder.php
│       ├── CategorySeeder.php
│       └── ProductSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php       # Layout customer
│       │   └── admin.blade.php     # Layout admin
│       ├── admin/
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── cart/
│       ├── orders/
│       ├── payment/
│       ├── products/
│       ├── profile/
│       └── home.blade.php
├── routes/
│   ├── web.php
│   └── auth.php
└── storage/
    └── app/public/
        ├── products/   # Foto produk
        └── avatars/    # Foto profil user
```

---

## ⚙️ Instalasi Lokal

### 1. Clone Repository
```bash
git clone https://github.com/Havinoia/vinshop.git
cd vinshop
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database
Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vinshop_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Konfigurasi Midtrans
Tambahkan di file `.env`:
```env
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

### 6. Migrasi & Seeder
```bash
php artisan migrate:fresh --seed
```

### 7. Storage Link
```bash
php artisan storage:link
```

### 8. Jalankan Aplikasi
```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

Buka browser ke `http://localhost:8000`

---

## ☁️ Hosting

Aplikasi ini di-hosting di **Railway** dengan konfigurasi:

| Komponen | Detail |
|---|---|
| Platform | Railway |
| URL | https://vinshop-production.up.railway.app |
| Database | MySQL (Railway) |
| PHP | 8.2 (FrankenPHP) |
| Deploy | Auto-deploy dari GitHub |

---

## 👤 Akun Default

| Role | Email | Password |
|---|---|---|
| Admin | admin@vinshop.com | password |
| Customer | customer@vinshop.com | password |

---

## 🔄 Alur Aplikasi

```
Customer:
Register/Login → Browse Produk → Detail Produk
→ Tambah ke Keranjang → Checkout
→ Bayar via Midtrans → Lihat Status Order

Admin:
Login → Dashboard → Kelola Kategori & Produk
→ Monitor & Update Status Order
```

---

## 🌐 Routes Utama

| Method | URL | Keterangan |
|---|---|---|
| GET | `/` | Homepage |
| GET | `/products` | Daftar produk |
| GET | `/products/{slug}` | Detail produk |
| GET | `/cart` | Keranjang belanja |
| POST | `/cart/add` | Tambah ke keranjang |
| GET | `/orders` | Riwayat pesanan |
| POST | `/orders` | Buat pesanan |
| GET | `/payment/{order}` | Halaman pembayaran Midtrans |
| POST | `/payment/notification` | Webhook Midtrans |
| GET | `/profile` | Edit profile & ganti password |
| GET | `/admin/dashboard` | Dashboard admin |
| GET | `/admin/products` | Kelola produk |
| GET | `/admin/categories` | Kelola kategori |
| GET | `/admin/orders` | Kelola pesanan |

---

## 💳 Testing Pembayaran Midtrans Sandbox

| Metode | Detail |
|---|---|
| QRIS | Scan QR → otomatis success |
| Kartu Kredit | `4811 1111 1111 1114` / Expiry: `01/26` / CVV: `123` / OTP: `112233` |
| GoPay | Klik Pay → otomatis success |
| Transfer Bank | Masukkan nomor VA → Confirm Payment |

---

## 📝 Lisensi

Project ini dibuat untuk keperluan pembelajaran. Free to use and modify.

---

Made with ❤️ by Havin
