<?php
// include database connection file
include("koneksi.php");
 
// Check if form is submitted for data update
if(isset($_POST['id_dokter'])){
	$id_dokter = $_POST['id_dokter'];
	$nama_dokter = $_POST['nama_dokter'];
	$alamat_dokter = $_POST['alamat_dokter'];
	$nohp_dokter = $_POST['nohp_dokter'];
	$id_poli = $_POST['id_poli'];
	$keterangan_dokter = $_POST['keterangan_dokter'];
	
	// Cek apakah user mengunggah foto baru
	if($_FILES['foto_dokter']['name'] != ""){
		$foto_dokter = $_FILES['foto_dokter']['name'];
		$tmp_foto = $_FILES['foto_dokter']['tmp_name'];
		$path = "foto/".$foto_dokter;

		// Hapus foto lama, jika ada
		$sql_foto = mysqli_query($connect, "SELECT foto_dokter FROM dokter WHERE id_dokter='$id_dokter'");
		if($data_foto = mysqli_fetch_array($sql_foto)){
			$foto_lama = $data_foto['foto_dokter'];
			if(file_exists("foto/".$foto_lama) && $foto_lama != ""){
				unlink("foto/".$foto_lama);
			}
		}

		// Pindahkan foto baru yang diunggah
		if(move_uploaded_file($tmp_foto, $path)){
			$query = "UPDATE dokter SET nama_dokter='$nama_dokter', alamat_dokter='$alamat_dokter', nohp_dokter='$nohp_dokter', id_poli='$id_poli', keterangan_dokter='$keterangan_dokter', foto_dokter='$foto_dokter' WHERE id_dokter='$id_dokter'";
		} else {
			echo "Maaf, gambar gagal untuk diupload.";
			exit;
		}
	} else {
		// Jika tidak merubah ukuran foto
		$query = "UPDATE dokter SET nama_dokter='$nama_dokter', alamat_dokter='$alamat_dokter', nohp_dokter='$nohp_dokter', id_poli='$id_poli', keterangan_dokter='$keterangan_dokter' WHERE id_dokter='$id_dokter'";
	}

    // execute update query
    $result = mysqli_query($connect, $query);
    
    // Redirect to homepage to display updated user in list
   	header("Location:manage_dokter.php");
}
?>