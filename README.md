# Pagination (Show All Style) - WordPress Plugin

**Pagination (Show All Style)** adalah plugin WordPress *premium-grade* yang berfungsi untuk membagi artikel panjang menjadi beberapa halaman secara otomatis berdasarkan jumlah kata. Plugin ini dirancang khusus untuk meningkatkan *Time on Site* dan *Ad Impressions* tanpa merusak pengalaman membaca.

---

## 📋 Deskripsi
Berbeda dengan fungsi `` bawaan WordPress yang bersifat manual, plugin ini bekerja secara otomatis dengan menghitung jumlah kata murni. 

Jika sebuah artikel melebihi batas tertentu (**500 kata**), plugin akan membaginya menjadi beberapa halaman dengan masing-masing berisi **400 kata**. Plugin ini juga menyediakan fitur **"Lihat Semua"** yang memungkinkan pembaca memuat seluruh konten dalam satu halaman melalui parameter URL khusus.

## ✨ Fitur Utama
* **Auto-Splitting Dinamis:** Membagi konten setiap 400 kata dengan presisi tinggi.
* **Threshold Cerdas:** Artikel di bawah 500 kata tidak akan dipaginasi untuk menjaga kualitas SEO.
* **Fitur "Lihat Semua":** Menyediakan tombol navigasi untuk memuat seluruh konten sekaligus (`?pg=all`).
* **HTML Safety:** Menggunakan fungsi `force_balance_tags` untuk mencegah kerusakan layout (seperti tag `<div>` atau `<b>` yang tidak tertutup) akibat pemotongan teks otomatis.
* **Desain Modern & Responsif:** Layout navigasi bersih dengan tombol "Lihat Semua" yang otomatis bergeser ke kanan pada desktop dan menjadi *full-width* pada perangkat mobile.
* **Adaptasi Tema:** Terintegrasi dengan CSS variabel WordPress (`--wp--preset--color--primary`) sehingga warna tombol otomatis mengikuti identitas tema Anda.

## 🛠️ Detail Teknis (Cara Kerja)
1.  **Word Counting:** Menghitung kata murni dengan membuang tag HTML sementara (`wp_strip_all_tags`) agar hitungan akurat.
2.  **Regex Splitting:** Memotong konten menggunakan `preg_split` untuk memastikan pemotongan terjadi pada spasi, bukan di tengah kata.
3.  **Query Parameter:** Menggunakan parameter `?pg=X` pada URL untuk menentukan halaman yang ditampilkan.
4.  **SEO Friendly:** Struktur URL tetap menggunakan `get_permalink()`, menjaga konsistensi dengan struktur permalink asli situs Anda.

## 📸 Visual Preview
Navigasi halaman akan muncul secara otomatis di bawah konten artikel:

**Halaman :**
| [ 1 ] | [ 2 ] | [ 3 ] | . . . | [ Lihat Semua ] |
| :--- | :--- | :--- | :--- | ---: |

* **Tombol Angka:** Terletak di sisi kiri.
* **Tombol Lihat Semua:** Otomatis menempel di sisi kanan (Desktop) atau memenuhi lebar layar (Mobile).
* **Warna:** Menyesuaikan otomatis dengan *Primary Color* tema WordPress Anda.

## 🚀 Instalasi
1.  Unduh atau salin file `wp-show-all-pagination.php`.
2.  Unggah ke direktori `/wp-content/plugins/wp-show-all-pagination/`.
3.  Aktifkan melalui Dashboard WordPress.
4.  Pastikan artikel Anda memiliki lebih dari 500 kata untuk melihat hasilnya secara otomatis.

## 🎨 Kustomisasi
Untuk mengubah jumlah kata per halaman, Anda dapat mengedit baris berikut pada file plugin:
```php
$words_per_page = 400; // Ubah angka sesuai kebutuhan (misal 500 atau 600)
