<?php
// Load file koneksi.php
include "koneksi.php";

// Ambil Data yang Dikirim dari Form
$nama_dokter = $_POST['nama_dokter'];
$alamat_dokter = $_POST['alamat_dokter'];
$nohp_dokter = $_POST['nohp_dokter'];
$id_poli = $_POST['id_poli'];
$keterangan_dokter = $_POST['keterangan_dokter'];

// Ambil data foto yang diupload
$foto_dokter = $_FILES['foto_dokter']['name'];
$tmp_foto = $_FILES['foto_dokter']['tmp_name'];

// Set path folder tempat menyimpan fotonya
// Pastikan folder "foto" sudah ada di direktori project Anda
$path = "foto/".$foto_dokter;

// Proses upload file ke folder "foto"
if(move_uploaded_file($tmp_foto, $path)){
    // Proses simpan ke Database (tambahkan field untuk foto sesuai dengan nama kolom di tabel dokter Anda, misal: foto)
    $query = "INSERT INTO dokter (nama_dokter, alamat_dokter, nohp_dokter, id_poli, keterangan_dokter, foto_dokter) VALUES('".$nama_dokter."', '".$alamat_dokter."', '".$nohp_dokter."', '".$id_poli."', '".$keterangan_dokter."', '".$foto_dokter."')";
    $sql = mysqli_query($connect, $query); // Eksekusi/ Jalankan query dari variabel $query

    if($sql){ // Cek jika proses simpan ke database sukses atau tidak
        // Jika Sukses, Lakukan :
        header("location: manage_dokter.php"); // Redirect ke halaman manage_dokter.php
    }else{
        // Jika Gagal, Lakukan :
        echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
        echo "<br><a href='tambah_dokter.php'>Kembali Ke Form</a>";
    }
} else {
    // Jika gambar gagal diupload
    echo "Maaf, Gambar gagal untuk diupload.";
    echo "<br><a href='tambah_dokter.php'>Kembali Ke Form</a>";
}
?>