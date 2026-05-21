# 3. Order Management System

Dokumen ini menjelaskan alur kerja pemesanan, manajemen status, dan logika bisnis *Pre-Order* pada platform Kulivio.

## 1. Alur Pemesanan (Order Flow)

Karena Kulivio menggunakan sistem **Pre-Order (PO)** dan pembayaran via **WhatsApp**, alurnya adalah sebagai berikut:

1.  **Discovery**: User melihat video produk di feed.
2.  **Checkout**: User memilih produk, memasukkan alamat pengiriman, dan melihat estimasi ongkir.
3.  **Order Created**: Pesanan dibuat dengan status `pending`.
4.  **WhatsApp Redirect**: User diarahkan ke WhatsApp Admin dengan pesan otomatis berisi detail pesanan dan instruksi pembayaran.
5.  **Payment Verification**: Admin memverifikasi bukti transfer secara manual dan mengubah status menjadi `paid`.
6.  **Processing**: Penjual (UMKM) menyiapkan pesanan sesuai tanggal ketersediaan (`expected_ready_date`).
7.  **Shipping**: Kurir internal mengambil pesanan dan mengubah status menjadi `shipped`.
8.  **Completion**: Pesanan diterima user dan status menjadi `completed`.

## 2. Definisi Status Pesanan

Sistem menggunakan kolom `status` pada tabel `orders` untuk melacak siklus hidup pesanan:

| Status | Deskripsi |
| :--- | :--- |
| `pending` | Pesanan baru dibuat, menunggu konfirmasi pembayaran via WhatsApp. |
| `paid` | Pembayaran telah dikonfirmasi oleh Admin. |
| `processing` | Produk dalam tahap pembuatan/persiapan oleh UMKM (Fase Pre-Order). |
| `shipped` | Produk telah diambil oleh kurir dan dalam perjalanan ke pembeli. |
| `completed` | Produk telah diterima dengan baik oleh pembeli. |
| `cancelled` | Pesanan dibatalkan (oleh user sebelum bayar atau oleh admin). |

## 3. Logika Pre-Order (PO)

Sebagai platform khusus UMKM kuliner, stok *ready-to-go* tidak tersedia. Beberapa poin kunci:

- **Expected Ready Date**: Setiap pesanan memiliki kolom `expected_ready_date` yang ditentukan berdasarkan estimasi waktu produksi UMKM.
- **No Stock Management**: Fokus bukan pada kuantitas stok yang tersedia saat ini, melainkan pada kapasitas produksi per hari/periode.
- **Batching**: Admin dapat mengelompokkan pesanan berdasarkan tanggal ketersediaan untuk efisiensi pengiriman.

## 4. Pengiriman & Kurir Manual

Sistem pengiriman dilakukan secara mandiri oleh tim internal (siswa):

- **Shipping Cost**: Dihitung berdasarkan `distance_km` (jarak) dari lokasi UMKM ke `delivery_address`.
- **Courier Assignment**: Admin menunjuk `courier_id` (User dengan role Kurir) untuk setiap pesanan yang siap kirim.
- **Real-time Tracking**: (Future Phase) Menggunakan `delivery_lat` dan `delivery_lng` untuk pelacakan lokasi pengiriman.

## 5. Integrasi WhatsApp

Dokumentasi detail mengenai format pesan dan alur komunikasi dapat dilihat di [5_WHATSAPP_INTEGRATION.md](5_WHATSAPP_INTEGRATION.md). Secara singkat:
- Tombol "Bayar Sekarang" akan men-generate URL `wa.me` dengan parameter teks yang berisi:
  - ID Pesanan
  - Total Tagihan
  - Daftar Item
  - Instruksi Transfer Bank
