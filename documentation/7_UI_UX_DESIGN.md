# UI/UX Design Plan: LaptopSakti Modern Showcase

## Objective
Merombak antarmuka pengguna (UI) aplikasi **LaptopSakti** menjadi modern, responsif, dan berbasis *Clean, Premium & Minimalist* dengan warna primer Oranye (representasi energi/sakti) dipadukan dengan aksen gelap/slate (representasi teknologi premium). Desain dioptimalkan secara spesifik: *Mobile-First* untuk antarmuka Pelanggan (karena format video pendek diakses via HP) dan *Desktop-First* untuk halaman Admin.

## Skema Warna & Tipografi
- **Primary Color:** Orange (`#F97316` / Tailwind `orange-500` ke `orange-600`) - Digunakan untuk aksen utama, tombol Call to Action (Beli via WA), bintang foto utama, dan badge harga.
- **Dark Elements:** Black (`#000000`) & Slate Dark (`#0F172A` / Tailwind `slate-900`) - Digunakan khusus untuk latar belakang Halaman Explore (Video Player) agar menyerupai pengalaman sinematik (TikTok/Reels), dan header katalog atas.
- **Background Color:** White & Light Slate (`#F8FAFC` / Tailwind `slate-50`) - Menjamin keterbacaan spesifikasi laptop pada halaman detail dan katalog.
- **Font:** Inter (Sans-serif bersih, modern, dan mudah dibaca di mobile).
- **Shape & Border:** Membulat (*rounded-xl* hingga *rounded-3xl*) untuk memberikan kesan modern, futuristik, dan ramah pengguna.

## Desain Berbasis Peran

### 1. Pelanggan (User) - *Mobile-Friendly*
Fokus pada pengalaman *discovery* melalui video pendek interaktif dan navigasi yang ringkas.
- **Navigasi Utama (Mobile):** *Bottom Navigation Bar* statis di bagian bawah layar. Menu: Beranda, Explore, Katalog, dan menu dinamis (Masuk/Profil/Admin).
- **Halaman Explore (Video Feed):**
  - Menggunakan layout tinggi penuh (viewport height) mirip TikTok/Reels di mana satu video fokus di tengah layar ponsel.
  - *Overlay UI* di bagian bawah kiri menampilkan nama laptop, deskripsi singkat, dan badge harga dengan tulisan tebal berwarna oranye.
  - Tombol aksi melayang (Beli via WA, Share, dan Mute) disusun vertikal di sisi kanan bawah.
- **Halaman Detail Produk:**
  - Media galeri interaktif dengan penampil utama di atas dan barisan thumbnail video/gambar di bawahnya.
  - Grid spesifikasi laptop menggunakan ikon visual minimalis (Brand, CPU, RAM, Storage, GPU, Screen Size).
  - Tombol melayang (sticky) "Hubungi Admin via WhatsApp" di bagian bawah layar ponsel.

### 2. Admin - *Desktop-First*
Fokus pada pengelolaan data spesifikasi, video review, dan pengaturan sistem dengan layout lebar.
- **Layout:** *Sidebar* persisten di kiri (warna putih dengan pembatas tipis, logo LaptopSakti berwarna oranye) dan panel konten utama di kanan.
- **Overview Dashboard:** Metrik cards informatif berisi total laptop terdaftar, video terunggah, dan admin aktif dengan visualisasi ikon yang bersih.
- **Tabel Manajemen (Clean Table):**
  - Desain tabel longgar dengan garis pembatas tipis.
  - Menggunakan *Pill Badge* untuk status ketersediaan laptop (Ready Stock/Out of Stock).
  - Dilengkapi fitur drag/klik untuk merotasi foto utama produk (bintang kuning) secara instan.
