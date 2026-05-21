# 4. Shipping Engine

Dokumen ini menjelaskan logika perhitungan ongkos kirim (ongkir) dan sistem manajemen pengiriman manual pada platform Kulivio.

## 1. Konsep Pengiriman Hyper-Local

Kulivio beroperasi dengan model *Hyper-Local*, di mana pengiriman dilakukan oleh kurir internal (siswa) dari lokasi UMKM langsung ke pelanggan. 

### Komponen Utama:
- **Base Location**: Lokasi titik kumpul atau lokasi UMKM.
- **Delivery Address**: Alamat tujuan yang dimasukkan oleh pelanggan saat checkout.
- **Distance-Based Pricing**: Biaya pengiriman dihitung secara dinamis berdasarkan jarak tempuh (KM).

## 2. Logika Perhitungan Ongkir

Ongkos kirim dihitung pada saat *checkout* menggunakan rumus sederhana:

`shipping_cost = distance_km * shipping_cost_per_km`

### Parameter Konfigurasi:
Data diambil dari tabel `settings`:
- **`shipping_cost_per_km`**: Tarif flat per kilometer. (Default saat ini: Rp 2.000,- berdasarkan `SettingSeeder`).

### Penentuan Jarak (`distance_km`):
Untuk tahap awal, jarak ditentukan melalui:
1.  **Google Maps API / Leaflet**: Menghitung jarak garis lurus atau rute jalan antara koordinat toko dan koordinat `delivery_lat`/`delivery_lng`.
2.  **Manual Input (Fallback)**: Jika API tidak tersedia, sistem menggunakan estimasi zona atau input manual dari Admin.

## 3. Alur Kerja Pengiriman (Manual Courier)

Karena menggunakan kurir internal, alur manajemennya adalah sebagai berikut:

1.  **Assignment**: Pesanan yang berstatus `paid` dan sudah siap (`processing` selesai) akan muncul di dashboard Admin. Admin menunjuk `courier_id` untuk pesanan tersebut.
2.  **Pickup**: Kurir mengubah status pesanan menjadi `shipped` saat mengambil barang dari UMKM.
3.  **Delivery**: Kurir melakukan perjalanan ke lokasi tujuan.
4.  **Proof of Delivery**: (Fase Lanjut) Kurir mengunggah foto bukti barang diterima atau memverifikasi melalui kode unik dari pelanggan.
5.  **Completion**: Setelah barang diterima, status diubah menjadi `completed`.

## 4. Pelacakan Lokasi (Future Implementation)

Sistem telah menyiapkan kolom `delivery_lat` dan `delivery_lng` pada tabel `orders` untuk:
- Menampilkan peta lokasi pengiriman bagi kurir.
- Memberikan estimasi waktu sampai kepada pembeli.
- (Opsional) Melacak posisi kurir secara *real-time* jika aplikasi kurir diaktifkan.

## 5. Aturan Bisnis Tambahan
- **Minimum Ongkir**: Dapat diterapkan batas minimum ongkir (misalnya, minimal Rp 5.000,- meskipun jarak < 2.5 KM).
- **Gratis Ongkir**: Sistem mendukung diskon ongkir melalui penggunaan `Coupon` (lihat tabel `coupons`).
