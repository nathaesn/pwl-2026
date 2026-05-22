# Proyek Poliklinik

Ini adalah aplikasi web berbasis PHP dan MySQL untuk sistem poliklinik.

## Persyaratan
Sebelum menjalankan aplikasi, pastikan Anda telah menginstal dan menjalankan:
1. **PHP** 
2. **Database MySQL** (menggunakan XAMPP, MAMP, atau MySQL Server terpisah).
3. Pastikan database `multi-user` beserta tabel `user` sudah dibuat di MySQL Anda.

## Cara Menjalankan Aplikasi di Mac/Linux (Built-in PHP Server)

Anda dapat langsung menjalankan aplikasi ini tanpa perlu memindahkan folder ke `htdocs` atau sejenisnya dengan menggunakan fitur server bawaan dari PHP. 

Berikut adalah langkah-langkahnya:

1. **Buka Terminal:**
   Buka aplikasi Terminal di Mac/Linux Anda.

2. **Arahkan ke Direktori Proyek:**
   Gunakan perintah `cd` untuk diarahkan ke folder proyek ini.
   ```bash
   cd /Users/andikanatha/Documents/PWL/poliklinik
   ```

3. **Jalankan PHP Web Server:**
   Eksekusi perintah berikut di dalam Terminal untuk menyalakan server lokal pada port 8000.
   ```bash
   php -S localhost:8000
   ```
   *(Pesan `Development Server started` akan muncul di terminal).*

4. **Buka di Browser:**
   Setelah server berjalan, buka browser Anda (Chrome, Safari, dll) dan akses link berikut:
   👉 **http://localhost:8000/login.php**

> **Catatan:** Biarkan jendela Terminal tetap terbuka selama Anda ingin menggunakan website ini. Jika ingin mematikan server, tekan tombol `Ctrl + C` pada keyboard di dalam Terminal.