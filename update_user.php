<?php
// include database connection file
include("koneksi.php");
 
// Check if form is submitted for user update, then redirect to homepage after update
	$id = $_POST["id"];
	$nama = $_POST["nama"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$level = $_POST["level"];
		      
    // update user data
	$query="UPDATE user SET nama='$nama', username='$username', password='$password', level='$level' WHERE id='$id'";
    $result = mysqli_query($connect,$query);
    
	 // update pasien data (hanya jika level adalah pasien)
	 if($level == 'pasien'){
		$query1="UPDATE pasien SET nama_pasien='$nama' WHERE id_pasien='$id'";
	    $result1 = mysqli_query($connect,$query1);
	 }
   	header("Location:manage_user.php");
?>