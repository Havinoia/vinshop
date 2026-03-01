# 🛍️ VinShop - E-Commerce Web App

Aplikasi e-commerce berbasis **Laravel 12** dengan fitur lengkap dan integrasi pembayaran **Midtrans**.

🌐 **Live Demo:** [https://vinshop-production.up.railway.app](https://vinshop-production.up.railway.app)

---

## 🚀 Teknologi

- **Laravel 12** + **Laravel Breeze** (Auth)
- **MySQL** - Database
- **Tailwind CSS** - Styling
- **Midtrans** - Payment Gateway (Sandbox)
- **Cloudinary** - Penyimpanan gambar permanen (tidak hilang saat redeploy)
- **Railway** - Cloud Hosting

---

## ✨ Fitur

**Customer:** Register/Login, Browse produk, Keranjang belanja, Checkout, Pembayaran Midtrans (QRIS/Transfer/GoPay), Riwayat pesanan, Edit profil & avatar

**Admin:** Dashboard statistik, Kelola kategori & produk (CRUD + upload foto), Kelola pesanan

---

## ☁️ Hosting & Storage

| Komponen | Detail |
|---|---|
| Hosting | Railway |
| URL | https://vinshop-production.up.railway.app |
| Database | MySQL (Railway) |
| Gambar | Cloudinary (persistent — tidak hilang saat redeploy) |
| Deploy | Auto-deploy dari GitHub |

> **Catatan:** Gambar produk dan avatar disimpan di **Cloudinary**, bukan di server Railway. Sehingga gambar tetap ada meskipun aplikasi di-redeploy berkali-kali.

---

## 👤 Akun Default

| Role | Email | Password |
|---|---|---|
| Admin | admin@vinshop.com | password |
| Customer | customer@vinshop.com | password |

---

## 💳 Testing Pembayaran (Sandbox)

| Metode | Detail |
|---|---|
| QRIS | Scan QR → otomatis success |
| Kartu Kredit | `4811 1111 1111 1114` / `01/26` / CVV `123` / OTP `112233` |
| GoPay | Klik Pay → otomatis success |
| Transfer Bank | Masukkan nomor VA → Confirm Payment |

---

## ⚙️ Instalasi Lokal

```bash
git clone https://github.com/Havinoia/vinshop.git
cd vinshop
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
```

Isi `.env` dengan konfigurasi database, Midtrans, dan Cloudinary:

```env
DB_DATABASE=vinshop_db
DB_USERNAME=root
DB_PASSWORD=

MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_IS_PRODUCTION=false

CLOUDINARY_CLOUD_NAME=your_cloud_name
CLOUDINARY_API_KEY=your_api_key
CLOUDINARY_API_SECRET=your_api_secret
```

Jalankan:

```bash
php artisan serve   # Terminal 1
npm run dev         # Terminal 2
```

---

Made with ❤️ by Havin
