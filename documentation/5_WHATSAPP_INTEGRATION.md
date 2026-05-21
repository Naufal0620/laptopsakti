# 5. WhatsApp Integration

Dokumen ini menjelaskan alur integrasi WhatsApp sebagai sistem konfirmasi pembayaran dan layanan pelanggan utama di platform Kulivio.

## 1. Peran WhatsApp dalam Transaksi

Fase awal Kulivio tidak menggunakan *payment gateway* otomatis (seperti Midtrans/Xendit) untuk meminimalkan biaya operasional dan menyesuaikan dengan kebiasaan UMKM. WhatsApp digunakan untuk:
- Konfirmasi pembayaran (mengirim bukti transfer).
- Koordinasi antara Admin dan Pembeli.
- Pemberitahuan status pesanan secara manual (opsional).

## 2. Alur Redireksi Pesanan (Order-to-WA)

Setelah pengguna menekan tombol **"Checkout"** atau **"Bayar Sekarang"**, sistem akan:
1.  Menyimpan data pesanan ke database dengan status `pending`.
2.  Menyusun pesan teks otomatis berbasis template.
3.  Mengarahkan pengguna ke URL: `https://wa.me/{admin_phone}?text={encoded_message}`.

## 3. Template Pesan Otomatis

Template pesan dirancang agar Admin dapat langsung mengenali detail pesanan tanpa bertanya balik.

**Format Template:**
```text
Halo Admin Kulivio! Saya ingin mengonfirmasi pembayaran untuk pesanan berikut:

🆔 ID Pesanan: #ORD-20260428-001
👤 Nama: [Nama User]
🛍️ Detail Item:
   - 2x Risol Mayo (Rp 10.000)
   - 1x Es Cendol (Rp 5.000)
💰 Total Tagihan: Rp 15.000
🚚 Alamat Kirim: [Alamat Lengkap]

Saya akan segera mengirimkan bukti transfernya. Terima kasih!
```

## 4. Konfigurasi Sistem

Data yang diperlukan untuk integrasi ini disimpan di tabel `settings`:
- **`admin_whatsapp_number`**: Nomor tujuan utama untuk konfirmasi pembayaran (format internasional, misal: `628123456789`).
- **`wa_message_template`**: Template teks dasar yang bisa diubah oleh admin melalui dashboard.

## 5. Verifikasi Manual oleh Admin

1.  Admin menerima pesan WhatsApp dan bukti transfer (foto/screenshot) dari pembeli.
2.  Admin memeriksa rekening bank perusahaan/UMKM.
3.  Setelah dana dipastikan masuk, Admin masuk ke Dashboard Admin Kulivio.
4.  Admin mencari ID Pesanan yang sesuai dan mengubah status dari `pending` menjadi `paid`.
5.  Sistem secara otomatis (atau via WA balik) menginfokan bahwa pembayaran telah diterima dan pesanan masuk ke tahap `processing`.

## 6. Pengembangan Masa Depan (Automated Notification)
- Menggunakan API pihak ketiga (seperti Fonnte atau WA Business API) untuk mengirim notifikasi perubahan status secara otomatis ke nomor `phone` user setiap kali status berubah menjadi `shipped` atau `completed`.
