# UI/UX Design Plan: Kulivio Modern E-Commerce

## Objective
Merombak antarmuka pengguna (UI) aplikasi Kulivio menjadi modern, responsif, dan berbasis *Clean & Minimalist* dengan warna primer Oranye. Desain akan dioptimalkan secara spesifik: *Mobile-First* untuk Pelanggan dan Kurir, serta *Desktop-First* untuk Admin.

## Skema Warna & Tipografi
- **Primary Color:** Orange (`#F97316` / Tailwind `orange-500` to `orange-600`) - Digunakan untuk tombol utama (Call to Action), icon aktif, dan badge harga.
- **Background Color:** White (`#FFFFFF`) & Very Light Gray (`#F9FAFB` / Tailwind `gray-50`) - Untuk memberikan kesan luas, bersih, dan menonjolkan konten (video/makanan).
- **Text Color:** Dark Gray (`#1F2937` / Tailwind `gray-800`) untuk judul, Medium Gray (`#4B5563` / Tailwind `gray-600`) untuk paragraf.
- **Font:** Inter atau Poppins (Sans-serif, bersih, mudah dibaca di mobile).
- **Shape & Border:** Membulat (*rounded-xl* hingga *rounded-2xl*) untuk memberikan kesan modern dan ramah, dipadukan dengan bayangan lembut (*shadow-sm* hingga *shadow-md*).

## Desain Berbasis Peran

### 1. Pelanggan (User) - *Mobile-Friendly*
Fokus pada pengalaman *discovery* yang mulus dan proses belanja yang minim hambatan.
- **Navigasi Utama:** *Bottom Navigation Bar* statis di bagian bawah layar. Menu: Eksplor (Home), Keranjang, Pesanan, Profil. Icon aktif akan menyala dengan warna Oranye.
- **Halaman Eksplor (Video Feed):**
  - Layout diatur agar satu video memakan porsi besar layar ponsel (meniru proporsi TikTok).
  - *Overlay UI:* Nama produk, nama toko, dan harga (teks tebal putih atau dalam *badge* transparan/oranye) melayang di area bawah kiri video.
  - Tombol aksi melayang (Like, Add to Cart) disusun vertikal di sisi kanan, dengan tombol beli utama berukuran besar.
- **Halaman Keranjang & Checkout:**
  - Desain membuang tampilan tabel lawas, beralih ke daftar *Card* produk tebal yang mudah di-tap dengan jari.
  - Elemen peta (Leaflet) ditampilkan secara *edge-to-edge* (sepenuh layar horizontal) atau di dalam kotak bersudut melengkung.
  - Ringkasan biaya melayang (sticky) di bagian bawah tepat di atas tombol "Pesan Sekarang" yang lebar (full-width) berwarna oranye.

### 2. Kurir (Courier) - *Mobile-Friendly*
Fokus pada kejelasan tugas operasional (lokasi dan aksi).
- **Dashboard (Daftar Tugas):** List pesanan menggunakan format *Card* tunggal yang besar. Setiap card berisi ID Pesanan, jarak (km), nama tujuan, dan status pengiriman (indikator warna tebal).
- **Halaman Detail Pengiriman:**
  - Fokus utama pada instruksi arah: Peta besar di bagian atas.
  - Area informasi pelanggan di bawahnya menggunakan tipografi besar agar mudah dibaca saat bergerak.
  - Dua tombol aksi ganda (Grid 2 Kolom) melekat di bagian bawah layar: "📞 Hubungi (WA)" (Garis tepi oranye/putih) dan "✅ Selesai Antar" (Warna solid oranye/hijau).

### 3. Admin - *Desktop-First*
Fokus pada densitas informasi, manajemen data, dan keterbacaan pada monitor lebar.
- **Layout:** *Sidebar* persisten di kiri (putih dengan bayangan kanan, logo Kulivio berwarna Oranye) dan panel konten di kanan.
- **Dashboard:** Kartu (*Card*) metrik berjajar di atas (Pesanan Aktif, Pendapatan, Kurir Bertugas) dilengkapi grafik ringkas.
- **Manajemen Data (Tabel):**
  - Tabel menggunakan garis batas horizontal yang sangat tipis (*clean look*).
  - Sel tabel berjarak longgar (padding besar) untuk menghindari kesan penuh sesak.
  - Status direpresentasikan dengan *Pill Badge* (cth: teks oranye berlatar oranye pudar untuk status *Processing*).
  - Aksi tabel diletakkan dalam *Dropdown* (titik tiga) atau *Icon Button* minimalis.

## Tahapan Implementasi (Phased Plan)
0. **Fase 0: Pembuatan & Pemutakhiran Dokumentasi (Completed)**
   - Menyimpan rancangan ini ke dalam file `documentation/7_UI_UX_DESIGN.md` dan memastikan seluruh dokumen selaras dengan sistem terbaru.
1. **Fase 1: Konfigurasi Tailwind & Layout Dasar**
   - Menyiapkan ekstensi warna/font di `tailwind.config.js`.
   - Membuat kerangka (wrapper) responsif dasar (Mobile container constraint untuk view User/Kurir).
2. **Fase 2: Refaktor UI User (Eksplor, Cart, Checkout)**
   - Fokus ke layouting video fullscreen dan form checkout interaktif.
3. **Fase 3: Refaktor UI Kurir**
   - Merombak tampilan detail order menjadi mirip aplikasi *driver* (layout fokus peta & tombol aksi).
4. **Fase 4: Pemolesan UI Admin Desktop**
   - Merapikan sidebar, tabel, dan halaman form.
