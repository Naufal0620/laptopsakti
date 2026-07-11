# 1. Database & Migrations

Dokumen ini menjelaskan struktur database untuk aplikasi **LaptopSakti**. Skema ini dirancang untuk mendukung fitur utama: **Content Discovery (Video Review)**, **Katalog Spesifikasi Laptop**, dan **Kontak WhatsApp Penjual**.

## A. Daftar Tabel Utama

### 1. `users`
Menyimpan data otentikasi administrator dan pengguna sistem.

| Column | Type | Constraints | Description |
| :--- | :--- | :--- | :--- |
| `id` | bigint | PK, Auto Increment | |
| `name` | string | | Nama user. |
| `email` | string | Unique | Alamat email user. |
| `password` | string | | Password hash. |
| `phone` | string | Nullable | Nomor WhatsApp/kontak. |
| `role` | enum | Default: 'customer' | `admin`, `customer` |
| `remember_token` | string | Nullable | |
| `timestamps` | - | - | `created_at`, `updated_at` |

### 2. `products`
Menyimpan informasi spesifikasi detail laptop yang dikatalogkan.

| Column | Type | Constraints | Description |
| :--- | :--- | :--- | :--- |
| `id` | bigint | PK, Auto Increment | |
| `name` | string | | Nama laptop. |
| `brand` | string | Nullable | Merek/Brand laptop (contoh: ASUS, Apple). |
| `description` | text | | Deskripsi produk/review ringkas. |
| `processor` | string | Nullable | Spesifikasi Processor. |
| `ram` | integer | Nullable | Kapasitas RAM dalam GB. |
| `storage` | integer | Nullable | Kapasitas SSD dalam GB. |
| `graphic_card` | string | Nullable | Spesifikasi GPU/Kartu Grafis. |
| `screen_size` | decimal | Nullable | Ukuran layar (inci). |
| `price` | integer | | Harga laptop dalam Rupiah. |
| `is_active` | boolean | Default: true | Status ketersediaan/aktif produk. |
| `sold` | integer | Default: 0 | Jumlah unit yang terjual. |
| `timestamps` | - | - | `created_at`, `updated_at` |

### 3. `product_images`
Menyimpan galeri foto untuk setiap laptop.

| Column | Type | Constraints | Description |
| :--- | :--- | :--- | :--- |
| `id` | bigint | PK, Auto Increment | |
| `product_id` | bigint | FK (`products`) | Relasi ke produk laptop. |
| `image_path` | string | | Path lokasi penyimpanan berkas foto. |
| `is_primary` | boolean | Default: false | Penanda gambar utama produk. |
| `timestamps` | - | - | |

### 4. `videos`
Menyimpan referensi video review pendek (feed) untuk penemuan interaktif produk (*Discovery*).

| Column | Type | Constraints | Description |
| :--- | :--- | :--- | :--- |
| `id` | bigint | PK, Auto Increment | |
| `product_id` | bigint | FK (`products`) | Relasi ke produk yang ditampilkan. |
| `video_path` | string | | Path lokasi berkas video (MP4). |
| `thumbnail_path`| string | Nullable | Path lokasi berkas gambar cover. |
| `status` | enum | Default: 'ready' | Status penayangan (`processing`, `ready`, `failed`). |
| `timestamps` | - | - | `created_at`, `updated_at` |

### 5. `settings`
Menyimpan konfigurasi aplikasi yang dapat diubah secara dinamis melalui Dashboard Admin.

| Column | Type | Constraints | Description |
| :--- | :--- | :--- | :--- |
| `id` | bigint | PK, Auto Increment | |
| `key` | string | Unique | Kunci unik (contoh: `admin_whatsapp_number`). |
| `display_name` | string | | Nama pengaturan yang ramah pengguna. |
| `value` | text | | Nilai pengaturan. |
| `type` | string | Default: 'string' | Tipe data (`integer`, `string`, `boolean`). |
| `group` | string | Default: 'general' | Pengelompokan pengaturan. |
| `timestamps` | - | - | |

## B. Pengaturan Dinamis (Konfigurasi)
Variabel global seperti nomor WhatsApp Admin utama disimpan di dalam tabel `settings`. Hal ini memungkinkan Administrator untuk mengubah kontak tujuan pembelian tanpa melalui perubahan kode program.

**Data Awal Pengaturan (SettingSeeder):**
* Key: `admin_whatsapp_number` | Value: `6285270110305` | Group: `general`
