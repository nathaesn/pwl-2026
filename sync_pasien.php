<?php
include "koneksi.php";

// Menambahkan data dari tabel user (khusus level pasien) ke tabel pasien
// dengan syarat nama belum ada di tabel pasien
$query = "INSERT INTO pasien (nama_pasien, alamat_pasien, noktp_pasien, nohp_pasien, norm_pasien)
          SELECT nama, '', '', '', '' 
          FROM user 
          WHERE level='pasien' AND nama NOT IN (SELECT nama_pasien FROM pasien)";

if (mysqli_query($connect, $query)) {
    echo "<h3>Sinkronisasi Berhasil!</h3>";
    echo "<p>" . mysqli_affected_rows($connect) . " data user telah ditambahkan ke tabel pasien.</p>";
    echo "<a href='index.php'>Kembali ke Login</a>";
} else {
    echo "Error: " . mysqli_error($connect);
}
?>