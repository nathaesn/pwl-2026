<!DOCTYPE html>
<html>
<head>
	<title>Riwayat Daftar Periksa</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style_sheet.css">
    <link rel="icon" type="image/png" href="assets/logo-udinus.png">
</head>
<body>
	<?php 
	session_start();
	if($_SESSION['level']==""){
		header("location:index.php?pesan=gagal");
	}
	include "koneksi.php";

	// Ambil username untuk navbar dan logic
	$username = $_SESSION["username"];
	$level = $_SESSION["level"];

	if (!function_exists('GetNama')) {
		function GetNama($u) { print $u; }
	}
	if (!function_exists('GetLevel')) {
		function GetLevel($l) { print $l; }
	}

	// Cari ID Pasien yang sedang login
	$cariUser = mysqli_query($connect, "SELECT * FROM user WHERE username='$username'");
	$userData = mysqli_fetch_array($cariUser);
	$nama_user = $userData['nama'];

	$cariPasien = mysqli_query($connect,"SELECT * FROM pasien WHERE nama_pasien='$nama_user'");
	$id_pasien = "";
	if(mysqli_num_rows($cariPasien) > 0){
		$pasien = mysqli_fetch_array($cariPasien);
		$id_pasien = $pasien['id_pasien'];
	}

	?>
    <div class="top-left">
        <img src="./assets/logo-udinus.png" alt="logo-udinus">
        <p class="title">POLIKLINIK</p>
        <p class="define">Clinic Universitas Dian Nuswantoro</p>
    </div>
    <div class="top-right">
        <p class="page-title">
      <p> 
			<b>Halaman Pasien</b><br>
			Halo : <b><?php echo $_SESSION['username']; ?></b><br>
			Anda telah login sebagai <b><?php echo $_SESSION['level']; ?></b>.
	  </p>
        </p>
        <div class="logout-button">
            <a href="logout.php"><b> Logout </b></a>
        </div>
    </div>
    <div class="horizontal-menu">
        <img src="./assets/logo-udinus.png" alt="profile">
        <div class="nama">
            <h2><?php GetNama($username) ?></h2>
            <h6><?php GetLevel($level) ?></h6>
        </div>
        <ul>
            <li><a href="halaman_pasien.php">Home</a></li>
            <li><a href="manage_pasien.php">Manage Pasien</a></li>
			<li><a href="manage_daftar.php">Manage Daftar</a></li>
			<li><a href="manage_antrian.php">Manage Antrian</a></li>
        </ul>
    </div>

<div style="margin-top:100px;margin-left:250px">
		<h4>Riwayat Pendaftaran & Pemeriksaan</h4>
        <table width="1027" style=" padding: 15px; text-align: left; border-collapse: collapse;">
            <tr style="background-color: #04AA6D; color: white; height: 40px;">
                <th>No Antrian</th>
                <th>Tanggal Periksa</th>
                <th>Nama Dokter</th>
				<th>Poli</th>	
				<th>Status</th>	
				<th>Waktu Daftar</th>
            </tr>
            
            <?php 
			if($id_pasien != ""){
				// Ambil data dari tabel daftar, gabung ke tabel dokter dan poli
                $query = mysqli_query($connect ,"
					SELECT d.nomor_antrian, d.tanggal_periksa, dk.nama_dokter, p.nama_poli, d.status_periksa, d.waktu_daftar
					FROM daftar d
					JOIN dokter dk ON d.id_dokter = dk.id_dokter
					JOIN poli p ON dk.id_poli = p.id_poli
					WHERE d.id_pasien = '$id_pasien'
					ORDER BY d.tanggal_periksa DESC, d.waktu_daftar DESC
				");
				
				if(mysqli_num_rows($query) > 0){
                    while($data=mysqli_fetch_array($query)) {
            ?>
					<tr style="border-bottom: 1px solid #ddd; height: 35px;">
						<td><?php echo $data['nomor_antrian'];?></td>
						<td><?php echo $data['tanggal_periksa'];?></td>
						<td><?php echo $data['nama_dokter'];?></td>
						<td><?php echo $data['nama_poli'];?></td>
						<td>
							<?php 
								if($data['status_periksa'] == 'menunggu'){
									echo "<span style='color: orange;'>Menunggu</span>";
								} else if($data['status_periksa'] == 'selesai') {
									echo "<span style='color: green;'>Selesai</span>";
								} else {
									echo "<span style='color: red;'>Batal</span>";
								}
							?>
						</td>
						<td><?php echo $data['waktu_daftar'];?></td>
					</tr>
            <?php
					}
				} else {
			?>
					<tr><td colspan="6" style="text-align:center; padding: 20px;">Belum ada riwayat pendaftaran.</td></tr>
			<?php
				}
			} else {
			?>
				<tr><td colspan="6" style="text-align:center; padding: 20px;">Data pasien tidak ditemukan.</td></tr>
			<?php
			}
			?>
		</table>
</div>

</body>
</html>
