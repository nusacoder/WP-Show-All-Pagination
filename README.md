# Pagination (Show All Style) - WordPress Plugin

**Pagination (Show All Style)** adalah plugin WordPress premium-grade yang berfungsi untuk membagi artikel panjang menjadi beberapa halaman secara otomatis berdasarkan jumlah kata. Plugin ini dirancang khusus untuk meningkatkan *Time on Site* dan *Ad Impressions* tanpa merusak pengalaman membaca.

## 📋 Deskripsi
Berbeda dengan fungsi `` bawaan WordPress yang manual, plugin ini bekerja secara otomatis dengan menghitung jumlah kata. Jika artikel melebihi batas tertentu (500 kata), plugin akan membaginya menjadi halaman-halaman berisi 400 kata. Menariknya, plugin ini menyediakan opsi **"Lihat Semua"** yang memungkinkan pembaca melihat seluruh konten dalam satu halaman melalui parameter URL.

## ✨ Fitur Utama
- **Auto-Splitting Dinamis:** Membagi konten setiap 400 kata secara presisi.
- **Threshold Cerdas:** Artikel di bawah 500 kata tidak akan dipaginasi agar tetap ramah SEO.
- **Fitur "Lihat Semua":** Menyediakan tombol navigasi untuk memuat seluruh konten sekaligus (`?pg=all`).
- **HTML Safety:** Menggunakan `force_balance_tags` untuk mencegah kerusakan layout (seperti tag `<div>` atau `<b>` yang tidak tertutup) akibat pemotongan otomatis.
- **Desain Modern & Responsif:** Layout navigasi yang bersih dengan tombol "Lihat Semua" yang otomatis bergeser ke kanan pada desktop dan menjadi *full-width* pada mobile.
- **Adaptasi Tema:** Menggunakan CSS variabel (`--wp--preset--color--primary`) agar warna tombol otomatis mengikuti warna utama tema WordPress Anda.

## 🛠️ Detail Teknis (Cara Kerja)
1. **Word Counting:** Menghitung kata murni dengan membuang tag HTML sementara (`wp_strip_all_tags`) agar hitungan akurat.
2. **Regex Splitting:** Memotong konten menggunakan `preg_split` untuk memastikan pemotongan terjadi pada spasi, bukan di tengah kata.
3. **Query Parameter:** Menggunakan parameter `?pg=X` pada URL untuk menentukan halaman mana yang harus ditampilkan.
4. **SEO Friendly:** Struktur URL tetap menggunakan `get_permalink()` sehingga tetap sinkron dengan struktur *permalink* asli situs Anda.

## 🚀 Instalasi
1. Unduh atau salin file `wp-show-all-pagination.php`.
2. Unggah ke direktori `/wp-content/plugins/wp-show-all-pagination.php/`.
3. Aktifkan melalui Dashboard WordPress.
4. Pastikan artikel Anda memiliki lebih dari 500 kata untuk melihat hasilnya.

## 🎨 Kustomisasi
Untuk mengubah jumlah kata per halaman, cari baris berikut:
```php
$words_per_page = 400; // Ubah angka sesuai kebutuhan (misal 500 atau 600)


## 📸 Visual Preview
Navigasi halaman akan muncul di bawah konten artikel dengan tata letak bersih:

**Halaman :**
| [ 1 ] | [ 2 ] | [ 3 ] | . . . | [ Lihat Semua ] |
| :--- | :--- | :--- | :--- | ---: |

*Keterangan:*
- Tombol angka berada di sisi kiri.
- Tombol **Lihat Semua** otomatis menempel di sisi kanan (Desktop) atau memenuhi lebar layar (Mobile).
- Warna tombol otomatis mengikuti *Primary Color* dari tema WordPress Anda.
