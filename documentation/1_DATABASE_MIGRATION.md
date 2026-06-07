# 1. Database & Migrations

Dokumen ini menjelaskan struktur database untuk aplikasi Kulivio. Skema ini dirancang untuk mendukung fitur utama: **Content Discovery (Video)**, **Pre-Order**, dan **Kalkulasi Ongkir Berbasis Jarak**.

## A. Daftar Tabel Utama

### 1. `users`
Menyimpan data otentikasi pengguna, termasuk hak akses (Customer, Admin, Courier) dan data kontak untuk integrasi WhatsApp.

| Column | Type | Constraints | Description |
| :--- | :--- | :--- | :--- |
| `id` | bigint | PK, Auto Increment | |
| `name` | string | | |
| `email` | string | Unique | |
| `password` | string | | |
| `phone` | string | Nullable | Nomor WhatsApp untuk komunikasi transaksi. |
| `role` | enum | Default: 'customer' | `admin`, `customer`, `courier` |
| `remember_token` | string | Nullable | |
| `timestamps` | - | - | `created_at`, `updated_at` |

### 2. `products`
Menyimpan informasi produk kuliner UMKM. Seluruh produk menggunakan sistem *Pre-Order*.

| Column | Type | Constraints | Description |
| :--- | :--- | :--- | :--- |
| `id` | bigint | PK, Auto Increment | |
| `name` | string | | Nama produk. |
| `description` | text | | Deskripsi produk. |
| `price` | integer | | Harga asli/dasar produk. |
| `discount_type` | enum | Default: 'none' | Tipe diskon produk: `none`, `percentage`, `fixed`. |
| `discount_value` | integer | Default: 0 | Nilai diskon yang memotong `price`. |
| `pre_order_days` | integer | Default: 1 | Waktu (dalam hari) yang dibutuhkan untuk pembuatan. |
| `is_active` | boolean | Default: true | Status ketersediaan produk. |
| `timestamps` | - | - | `created_at`, `updated_at` |

### 3. `product_images`
Menyimpan banyak gambar untuk setiap produk. Satu produk bisa memiliki banyak gambar dengan satu gambar utama.

| Column | Type | Constraints | Description |
| :--- | :--- | :--- | :--- |
| `id` | bigint | PK, Auto Increment | |
| `product_id` | bigint | FK (`products`) | Relasi ke produk. |
| `image_path` | string | | Path/URL file gambar. |
| `is_primary` | boolean | Default: false | Penanda gambar utama produk. |
| `timestamps` | - | - | |

### 4. `videos`
Menyimpan referensi video konten untuk penemuan produk (*Discovery*).

| Column | Type | Constraints | Description |
| :--- | :--- | :--- | :--- |
| `id` | bigint | PK, Auto Increment | |
| `product_id` | bigint | FK (`products`) | Relasi ke produk yang ditampilkan. |
| `video_path` | string | | Path/URL file video utama. |
| `thumbnail_path`| string | Nullable | Path/URL file gambar thumbnail. |
| `status` | enum | Default: 'ready' | Status penayangan (`processing`, `ready`, `failed`). |
| `timestamps` | - | - | `created_at`, `updated_at` |

### 5. `orders`
Mencatat transaksi pemesanan, informasi logistik berbasis jarak, dan status alur *Pre-Order*.

| Column | Type | Constraints | Description |
| :--- | :--- | :--- | :--- |
| `id` | bigint | PK, Auto Increment | |
| `user_id` | bigint | FK (`users`) | Pembeli. |
| `courier_id` | bigint | FK (`users`), Nullable | Kurir internal (siswa) yang ditugaskan. |
| `coupon_id` | bigint | FK (`coupons`), Nullable | Kupon yang digunakan (jika ada). |
| `delivery_address` | text | | Alamat lengkap tujuan pengiriman. |
| `delivery_lat` | decimal | Nullable | Koordinat Latitude tujuan (untuk Maps API). |
| `delivery_lng` | decimal | Nullable | Koordinat Longitude tujuan (untuk Maps API). |
| `distance_km` | decimal | | Jarak pengiriman hasil kalkulasi (dalam KM). |
| `total_price` | integer | | Total harga barang sebelum diskon. |
| `shipping_cost` | integer | | Biaya ongkir (dihitung dinamis: Tarif/KM * Jarak). |
| `discount_amount` | integer | Default: 0 | Nominal potongan harga dari kupon/diskon. |
| `grand_total` | integer | | `(total_price + shipping_cost) - discount_amount`. |
| `status` | enum | Default: 'pending'| `pending`, `paid`, `processing`, `shipped`, `completed`, `cancelled`. |
| `proof_of_delivery`| string | Nullable | Path/URL foto bukti barang diterima (diunggah kurir). |
| `expected_ready_date`| datetime | Nullable | Tanggal & Waktu estimasi pesanan siap dikirim. |
| `timestamps` | - | - | `created_at`, `updated_at` |

### 6. `coupons`
Menyimpan data voucher dan diskon yang dapat digunakan oleh pelanggan.

| Column | Type | Constraints | Description |
| :--- | :--- | :--- | :--- |
| `id` | bigint | PK, Auto Increment | |
| `code` | string | Unique | Kode unik voucher (misal: MERDEKA10). |
| `type` | enum | | Tipe diskon: `percentage` atau `fixed`. |
| `value` | integer | | Nilai diskon (persen atau nominal rupiah). |
| `max_discount` | integer | Nullable | Batas maksimal diskon (untuk tipe persentase). |
| `min_order` | integer | Default: 0 | Minimal pembelian untuk menggunakan voucher. |
| `start_date` | datetime | | Tanggal mulai berlaku. |
| `end_date` | datetime | | Tanggal kadaluarsa. |
| `usage_limit` | integer | Nullable | Total kuota penggunaan voucher secara global. |
| `limit_per_user`| integer | Default: 1 | Batas penggunaan per pelanggan. |
| `is_active` | boolean | Default: true | Status aktif/non-aktif voucher. |
| `timestamps` | - | - | `created_at`, `updated_at` |

### 7. `order_items`
Menyimpan rincian produk untuk setiap transaksi pesanan.

| Column | Type | Constraints | Description |
| :--- | :--- | :--- | :--- |
| `id` | bigint | PK, Auto Increment | |
| `order_id` | bigint | FK (`orders`) | Relasi ke tabel Order. |
| `product_id` | bigint | FK (`products`) | Relasi ke tabel Produk. |
| `quantity` | integer | | Jumlah barang yang dipesan. |
| `price_at_time` | integer | | Harga produk saat transaksi (mencegah perubahan harga historis). |
| `timestamps` | - | - | `created_at`, `updated_at` |

### 8. `settings`
Menyimpan konfigurasi aplikasi yang dapat diubah secara dinamis melalui Dashboard Admin.

| Column | Type | Constraints | Description |
| :--- | :--- | :--- | :--- |
| `id` | bigint | PK, Auto Increment | |
| `key` | string | Unique | Kunci unik (contoh: `shipping_cost_per_km`). |
| `display_name` | string | | Nama pengaturan yang mudah dibaca. |
| `value` | text | | Nilai pengaturan. |
| `type` | string | Default: 'string' | Tipe data (`integer`, `string`, `boolean`). |
| `group` | string | Default: 'general' | Pengelompokan (contoh: `shipping`). |
| `timestamps` | - | - | |

## B. Pengaturan Dinamis (Konfigurasi)
Variabel seperti tarif dasar ongkos kirim per Kilometer (KM) disimpan di dalam tabel `settings`. Hal ini memungkinkan Administrator untuk mengubah kebijakan tarif tanpa melalui perubahan kode atau file environment.

**Contoh Data Awal (Seeder):**
- Key: `shipping_cost_per_km` | Value: `2000` | Group: `shipping`
- Key: `store_latitude` | Value: `-6.2088` | Group: `shipping`
- Key: `store_longitude` | Value: `106.8456` | Group: `shipping`
- Key: `admin_whatsapp_number` | Value: `628123456789` | Group: `whatsapp`
