<?php
session_start();
include "koneksi.php";

// Cek login
if(!isset($_SESSION['username'])){
    header("location:index.php?pesan=gagal");
    exit;
}

$username = $_SESSION['username'];

// Cari user berdasarkan username
$cariUser = mysqli_query($connect, "SELECT * FROM user WHERE username='$username'");
$userData = mysqli_fetch_array($cariUser);

if(!$userData){
    die("User tidak ditemukan");
}

$id_user = $userData['id'];
$nama_user = $userData['nama'];

// Cari pasien berdasarkan nama_pasien yang sama dengan nama user
// Jika tidak ditemukan, buat data pasien baru
$cariPasien = mysqli_query($connect, "SELECT * FROM pasien WHERE nama_pasien='$nama_user'");
$pasien = mysqli_fetch_array($cariPasien);

if(!$pasien){
    // Buat data pasien baru jika belum ada
    mysqli_query($connect, "INSERT INTO pasien(nama_pasien) VALUES('$nama_user')");
    $id_pasien = mysqli_insert_id($connect);
} else {
    $id_pasien = $pasien['id_pasien'];
}

// Dokter yang dipilih
$id_dokter = $_GET['id_dokter'];
$tanggal = date("Y-m-d");

// Cek apakah pasien sudah mendaftar hari ini dengan dokter yang sama
$cekDaftar = mysqli_query($connect, "SELECT * FROM daftar WHERE id_pasien='$id_pasien' AND id_dokter='$id_dokter' AND tanggal_periksa='$tanggal'");
if(mysqli_num_rows($cekDaftar) > 0){
    header("location: manage_daftar.php?pesan=sudah_daftar");
    exit;
}

// Cek jumlah antrian
$cek = mysqli_query($connect, "SELECT COUNT(*) jumlah FROM daftar WHERE id_dokter='$id_dokter' AND tanggal_periksa='$tanggal'");
$data = mysqli_fetch_array($cek);
$jumlah = $data['jumlah'];

// Maksimal 10
if($jumlah >= 10){
    header("location: manage_daftar.php?pesan=penuh");
    exit;
}

// Nomor berikutnya
$nomor = $jumlah + 1;

// Simpan
mysqli_query($connect, "INSERT INTO daftar(id_pasien,id_dokter,tanggal_periksa,nomor_antrian)
VALUES('$id_pasien','$id_dokter','$tanggal','$nomor')");

header("location: manage_daftar.php?pesan=berhasil&nomor=$nomor");
?>