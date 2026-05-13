<?php 

	$host = "127.0.0.1"; // Menggunakan 127.0.0.1 agar tidak terjadi error socket (No such file or directory)
	$username = "root"; // Username
	$password = ""; // Password (Isi jika menggunakan password)
	$database = "multi-user"; // Nama databasenya

	$connect = mysqli_connect($host, $username, $password, $database);

	// Check connection
	if (mysqli_connect_errno()){
		echo "Koneksi database gagal : " . mysqli_connect_error();
	} // Hapus echo "Koneksi database berhasil!"; agar tidak bocor ke tampilan
?>