# 5. WhatsApp Integration

Dokumen ini menjelaskan alur integrasi WhatsApp sebagai media komunikasi utama untuk transaksi dan layanan pelanggan di platform **LaptopSakti**.

## 1. Peran WhatsApp dalam Transaksi

LaptopSakti tidak menggunakan *payment gateway* otomatis (seperti Midtrans/Xendit) maupun sistem checkout transaksi di dalam database web. Sistem e-commerce dioperasikan dengan metode **Direct WhatsApp Redirection**:
- Pelanggan melakukan pemesanan dan konsultasi secara langsung dengan Admin/Penjual.
- Semua koordinasi mengenai metode pembayaran (transfer bank, e-wallet, dll.) dan pengiriman dilakukan di dalam chat WhatsApp.
- Status penjualan/stok (seperti mengubah unit terjual/`sold` atau status aktif/`is_active`) dikelola secara manual oleh Admin melalui Dashboard Admin web.

## 2. Alur Redireksi Pemesanan (Order-to-WA)

Ketika pengguna mengeklik tombol **"Beli"** di halaman Explore Feed (Video Player) atau tombol **"Hubungi Admin via WhatsApp"** di halaman Detail Produk, sistem akan:
1. Menyusun pesan teks otomatis berbasis data laptop (Nama & Harga).
2. Membuka URL WhatsApp API: `https://wa.me/{admin_whatsapp_number}?text={encoded_message}` pada tab baru browser.

## 3. Template Pesan Otomatis

Pesan yang dikirimkan diformat secara terstruktur agar Admin dapat langsung mengenali produk yang diminati pelanggan tanpa perlu bertanya kembali.

### Format Template:
```text
Halo LaptopSakti! Saya tertarik untuk membeli laptop berikut:

💻 Laptop: [Nama Laptop]
💵 Harga: Rp [Harga Terformat]

Apakah laptop ini masih tersedia?
```

## 4. Konfigurasi Sistem

Nomor WhatsApp Admin utama disimpan di dalam database pada tabel `settings` dengan konfigurasi sebagai berikut:
- **Key**: `admin_whatsapp_number`
- **Display Name**: `Nomor WhatsApp Penjual`
- **Value**: `6285270110305` (Menggunakan format internasional tanpa simbol `+` atau spasi)
- **Type**: `string`
- **Group**: `general`

Admin dapat mengubah nomor WhatsApp tujuan ini kapan saja melalui halaman **Pengaturan Sistem** di Dashboard Admin.
