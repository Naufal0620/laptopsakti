# 6. E-Commerce System (Shopping Features)

Dokumen ini menjelaskan fungsionalitas belanja pada Kulivio yang mengadopsi standar marketplace modern (seperti Tokopedia/Shopee), namun disesuaikan dengan model bisnis *Pre-Order* dan *Video-First Discovery*.

## 1. Discovery & Search (Pencarian Produk)

Meskipun fokus utama adalah feed video (Discovery), sistem tetap menyediakan fitur pencarian konvensional untuk memudahkan pengguna menemukan produk spesifik.

### Mekanisme:
- **Search Bar**: Mencari berdasarkan nama produk atau deskripsi (tabel `products`).
- **Discovery Mode**: Hasil pencarian dapat ditampilkan dalam format **Video Grid** (prioritas) atau **Product Card**.
- **Filter**: Pengguna dapat memfilter berdasarkan rentang harga (`price`), kategori (jika ada), dan estimasi waktu PO (`pre_order_days`).

## 2. Shopping Cart (Keranjang Belanja)

Fitur keranjang memungkinkan pengguna untuk mengumpulkan beberapa produk sebelum melakukan checkout.

### Logika Keranjang:
- **Multi-Product**: Pengguna dapat menambahkan berbagai item dari UMKM yang berbeda.
- **Persistence**: Keranjang disimpan di sisi server (database/session) sehingga tidak hilang saat pengguna berpindah perangkat.
- **Pre-Order Awareness**: Keranjang akan memberikan peringatan jika produk memiliki waktu PO yang berbeda jauh, karena akan mempengaruhi jadwal pengiriman.

## 3. Promotion & Discount Engine

Sistem promosi dirancang untuk meningkatkan konversi belanja.

### Fitur Promo:
- **Product-Level Discount**: Diskon langsung pada produk menggunakan kolom `discount_type` dan `discount_value` di tabel `products`. Sistem menyediakan *Computed Attribute* `discounted_price` untuk memudahkan perhitungan. Harga coret akan ditampilkan di UI.
- **Coupon Code**: Pengguna dapat memasukkan kode voucher saat di halaman Checkout.
- **Validation Logic (Server-Side)**:
  - **Status**: Cek `is_active`.
  - **Masa Berlaku**: Cek `start_date` & `end_date` terhadap waktu sekarang.
  - **Minimal Belanja**: Cek `min_order` terhadap `total_price` di keranjang.
  - **Kuota Global**: Cek `usage_limit` terhadap total penggunaan di tabel `orders`.
  - **Kuota User**: Cek `limit_per_user` terhadap jumlah pesanan user tersebut yang menggunakan kupon ini.
- **Discount Calculation**:
  - `percentage`: Memotong persentase harga dengan batas `max_discount` (jika ada).
  - `fixed`: Memotong nominal harga secara tetap.

## 4. Checkout Experience

Proses checkout dirancang agar ringkas namun informatif, mirip dengan marketplace besar.

### Langkah Checkout:
1.  **Summary**: Menampilkan daftar item, kuantitas, dan subtotal.
2.  **Shipping Address**: Pengguna memilih atau memasukkan alamat (disimpan di `delivery_address`).
3.  **Shipping Calculation**: Sistem menghitung ongkir secara real-time berdasarkan jarak (`distance_km`) menggunakan `Shipping Engine`.
4.  **Promo Application**: Menghitung potongan harga dari kupon yang valid.
5.  **Grand Total Calculation**: `(Total Item + Ongkir) - Diskon`.
6.  **Place Order**: Menyimpan ke tabel `orders` dan `order_items`, kemudian memicu redireksi WhatsApp.

## 5. User Dashboard (Manajemen Pesanan)

Halaman khusus bagi pelanggan untuk memantau aktivitas belanja mereka.

### Fitur Dashboard:
- **Order History**: Daftar seluruh pesanan yang pernah dibuat.
- **Status Tracking**: Visualisasi status pesanan (`Pending` -> `Paid` -> `Processing` -> `Shipped` -> `Completed`) dengan progress bar.
- **Quick Buy**: Fitur untuk memesan kembali produk yang pernah dibeli sebelumnya.
- **Profile Management**: Menyimpan nomor WhatsApp (`phone`) dan alamat utama untuk mempercepat proses checkout di masa mendatang.

## 6. Sinkronisasi Database

Fitur-fitur di atas didukung oleh tabel-tabel berikut:
- **`products`**: Sumber data produk dan diskon level produk.
- **`coupons`**: Sumber data voucher diskon.
- **`orders` & `order_items`**: Penyimpan data transaksi dan rincian item.
- **`settings`**: Konfigurasi tarif ongkir dan pesan WhatsApp.
