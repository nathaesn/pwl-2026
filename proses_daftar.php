<?php
session_start();
include "koneksi.php";
/* ambil pasien login misal username pasien*/
$username = $_SESSION['username'];
$cariUser = mysqli_query($connect, "SELECT * FROM user WHERE username='$username'");
$userData = mysqli_fetch_array($cariUser);
$nama_user = $userData['nama'];

/* cari id pasien */
$cariPasien = mysqli_query($connect,"SELECT * FROM pasien WHERE nama_pasien='$nama_user'");
$pasien = mysqli_fetch_array($cariPasien);
$id_pasien = $pasien['id_pasien'];
/* dokter dipilih */
$id_dokter = $_GET['id_dokter'];
$tanggal = date("Y-m-d");
/* cek jumlah antrian */
$cek = mysqli_query($connect,"SELECT COUNT(*) jumlah FROM daftar WHERE id_dokter='$id_dokter' AND tanggal_periksa='$tanggal'");
$data = mysqli_fetch_array($cek);
$jumlah = $data['jumlah'];
/* maksimal 10 */
if($jumlah>=10)
{
    header("location: manage_daftar.php?pesan=penuh");
    exit;
}
/* nomor berikutnya */
$nomor = $jumlah+1;
/* simpan */
mysqli_query($connect,"INSERT INTO daftar(id_pasien,id_dokter,tanggal_periksa,nomor_antrian)
VALUES('$id_pasien','$id_dokter','$tanggal','$nomor')");

header("location: manage_daftar.php?pesan=berhasil&nomor=$nomor");
?>