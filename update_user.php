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
    
    // Redirect to homepage to display updated user in list
   	header("Location:manage_user.php");
?>