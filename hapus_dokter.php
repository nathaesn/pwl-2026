<?php
// include database connection file
include("koneksi.php");
 
// Get id_dokter from URL to delete that user
$id = $_GET['id'];

// Get photo name to delete file from folder (optional but recommended)
try {
    $sql_foto = mysqli_query($connect, "SELECT foto_dokter FROM dokter WHERE id_dokter='$id'");
    if($sql_foto && $data_foto = mysqli_fetch_array($sql_foto)){
        $foto_lama = $data_foto['foto_dokter'];
        if(file_exists("foto/".$foto_lama) && $foto_lama != ""){
            unlink("foto/".$foto_lama);
        }
    }
} catch (Exception $e) {
    // Abaikan jika kolom 'foto' belum ada di database
}
 
// Delete dokter row from table based on given id
$result = mysqli_query($connect, "DELETE FROM dokter WHERE id_dokter='$id'");
 
// After delete redirect to manage_dokter.php
header("Location:manage_dokter.php");
?>