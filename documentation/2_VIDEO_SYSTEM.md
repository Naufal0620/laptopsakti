# 2. Video System Architecture

Dokumen ini menjelaskan teknis implementasi fitur **Video-First Discovery** pada LaptopSakti. Sistem ini difokuskan pada manajemen file video standar yang diunggah oleh Admin/Seller.

## A. Arsitektur Video

### 1. Alur Kerja (Workflow)
`Upload Video` -> `Validation` -> `Storage` -> `Thumbnail Generation (Optional)` -> `Streaming/Playback`

- **Upload**: Admin/Seller mengunggah file video produk yang sudah siap (Format: MP4, Max: 20MB). Video bisa berasal dari rekaman kamera maupun hasil generator AI eksternal.
- **Validation**: Sistem mengecek durasi (maksimal 60 detik), ukuran file, dan aspek rasio (Portrait 9:16).
- **Storage**: Video disimpan di penyimpanan lokal/cloud yang terorganisir.

### 2. Penyimpanan (Storage)
Menggunakan Laravel File Storage dengan struktur folder:
- Video: `storage/app/public/videos/{product_id}/{filename}.mp4`
- Thumbnail: `storage/app/public/thumbnails/{product_id}/{filename}.jpg`

## B. Manajemen Data
Tabel `videos` menyimpan referensi file:
- `video_path`: Lokasi file video.
- `thumbnail_path`: Lokasi file gambar sampul.
- `status`: `ready` (siap tonton) atau `failed` (jika ada masalah file).

## C. Optimasi Performa (Bandwidth & Latency)

### 1. Lazy Loading & Autoplay
- Video hanya dimuat saat masuk ke viewport menggunakan **Intersection Observer API**.
- Menggunakan atribut `preload="metadata"` agar browser hanya mengambil info durasi/ukuran tanpa mengunduh seluruh isi video di awal.

### 2. Playback Control
- **Muted Autoplay**: Video diputar otomatis tanpa suara saat terlihat.
- **Interaction**: User melakukan klik/tap untuk mengaktifkan suara (*unmute*).
- **Looping**: Video berputar terus-menerus untuk meningkatkan *engagement*.

## D. Spesifikasi Teknis Video
- **Format**: MP4 (Codec: H.264/AAC).
- **Rasio**: 9:16 (Portrait) - Dioptimalkan untuk layar smartphone.
- **Resolusi**: Maksimal 720p (HD Ready) untuk menjaga keseimbangan kualitas dan kecepatan *buffering*.
- **Durasi**: Direkomendasikan 15 - 30 detik.

## E. Catatan Penting
Aplikasi tidak bertanggung jawab atas proses pembuatan konten (AI/Manual). Aplikasi hanya bertugas untuk **menyimpan, mengelola, dan menampilkan** video tersebut agar pembeli dapat menemukan produk dengan cara yang lebih menarik.
