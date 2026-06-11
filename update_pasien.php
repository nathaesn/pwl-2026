<?php
// include database connection file
include("koneksi.php");
 
// Check if form is submitted for user update, then redirect to homepage after update
    $id_pasien = $_POST['id_pasien'];
	$nama_pasien = $_POST['nama_pasien'];
    $alamat_pasien = $_POST['alamat_pasien'];
	$noktp_pasien = $_POST['noktp_pasien'];
	$nohp_pasien = $_POST['nohp_pasien'];
	$norm_pasien = $_POST['norm_pasien'];
		      
    // update user data
	$query="UPDATE pasien SET nama_pasien='$nama_pasien', alamat_pasien='$alamat_pasien', noktp_pasien='$noktp_pasien', nohp_pasien='$nohp_pasien' , norm_pasien='$norm_pasien' WHERE id_pasien='$id_pasien'";
    $result = mysqli_query($connect,$query);
    
    // Redirect to homepage to display updated user in list
   	header("Location:manage_pasien.php");
?>