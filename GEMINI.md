# Kulivio - E-Commerce UMKM Kuliner (Video-Based) - Project Guidelines

**Kulivio** adalah platform E-Commerce khusus produk kuliner UMKM yang menggabungkan konsep *Content Discovery* berbasis video (seperti TikTok) dengan *Hyper-Local E-Commerce* (seperti GoFood).

## 🛠️ Tech Stack
- **Framework:** Laravel 12.x (Latest)
- **Frontend:** Laravel Blade, Alpine.js, Tailwind CSS
- **Database:** MySQL
- **Features:** Video-First Discovery, Pre-Order System, WhatsApp Payment API

---

## 🏗️ Arsitektur & Aturan Bisnis (Core Logic)

### 1. Model Bisnis: Video-First Discovery
- Produk ditampilkan melalui streaming video pendek untuk meningkatkan engagement.
- Optimasi pada bandwidth, latency, dan caching video sangat krusial.

### 2. Sistem Pemesanan (Pre-Order Only)
- Seluruh produk kuliner wajib dipesan secara **Pre-Order**.
- Tidak ada sistem stok *ready-to-go* untuk menjamin kualitas dan kesegaran produk UMKM.

### 3. Pembayaran & Transaksi
- **WhatsApp Integration**: Untuk fase awal, konfirmasi dan instruksi pembayaran dilakukan melalui WhatsApp.
- Sistem harus mencatat status pesanan (Pending, Paid, Processing, Shipped, Completed).

### 4. Logistik & Pengiriman
- **Manual Courier**: Pengiriman dilakukan secara mandiri oleh tim internal (siswa).
- **Shipping Estimation**: Sistem harus memiliki logika untuk menghitung estimasi biaya ongkir berdasarkan jarak atau zona.

---

## 💻 Strategi Pengembangan & Standar Koding

### 1. Alur Kerja "System-First"
- **Prioritas Utama**: Bangun fungsionalitas sistem (Backend, Database, Order Flow) terlebih dahulu.
- **UI/UX**: Gunakan desain minimalis/standar di awal. Pemolesan UI (Rich Aesthetics) dilakukan setelah sistem inti stabil.

### 2. Database & Eloquent
- Gunakan migrasi yang bersih dengan relasi yang tepat antara `Users`, `Products`, `Videos`, dan `Orders`.
- Simpan metadata video AI (prompt, status generasi) jika diperlukan.

### 3. Timeline & Pelaporan
- **Weekly Progress**: Update setiap **Senin** kepada Pak Dedy.
- **Mid-Point Goal**: Sistem fungsional (bisa digunakan) sebelum **15 Mei 2026**.
- **Final Deadline**: **Juni 2026**.

---

## 📂 Struktur Dokumentasi & Status Implementasi
- [x] `1_DATABASE_MIGRATION.md`: Skema tabel Produk, Video, dan Order.
- [x] `2_VIDEO_SYSTEM.md`: Arsitektur streaming dan feed video (TikTok-style).
- [x] `3_ORDER_MANAGEMENT.md`: Alur Pre-Order, Manajemen Status, dan Kurir.
- [x] `4_SHIPPING_ENGINE.md`: Logika perhitungan ongkir otomatis via Maps.
- [x] `5_WHATSAPP_INTEGRATION.md`: Alur transaksi via WhatsApp (Konfirmasi Checkout Selesai).
- [x] `6_ECOMMERCE_SYSTEM.md`: Fitur belanja (Cart, Search, Promo) ala Marketplace.
- [ ] `7_UI_UX_DESIGN.md`: Panduan desain (Sedang dipoles).

---
*Terakhir diperbarui: 27 April 2026 - Berdasarkan Mandat @MYNOTE.md*
