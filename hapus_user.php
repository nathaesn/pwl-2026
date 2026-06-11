<?php
// include database connection file
include("koneksi.php");
 // Get id from URL to delete that user
$id = $_GET['id'];
 // Delete user row from table based on given id
$query="DELETE FROM user WHERE id=$id";
$result = mysqli_query($connect,$query);
 // Delete pasien row from table based on given id
$query1="DELETE FROM pasien WHERE id_pasien=$id";
$result1 = mysqli_query($connect,$query1);
 // After delete redirect to Home, so that latest user list will be displayed.
header("Location:manage_user.php");
?>
