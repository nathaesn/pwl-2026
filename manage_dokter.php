<!DOCTYPE html>
<html>
<head>
	<title>Halaman admin - Manage Dokter</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style_sheet.css">
    <link rel="icon" type="image/png" href="assets/logo-udinus.png">
</head>
<body>
	<?php 
	session_start();

	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['level']==""){
		header("location:index.php?pesan=gagal");
	}

	?>
	    <div class="top-left">
        <img src="./assets/logo-udinus.png" alt="logo-udinus">
        <p class="title">
            POLIKLINIK
        </p>
        <p class="define">
            Clinic Universitas Dian Nuswantoro
        </p>
        
    </div>
    <div class="top-right">
        <p class="page-title">
      <p> 
			<b>Halaman Admin</b>
			<br>
			Halo : <b><?php echo $_SESSION['username']; 
			 			$username = $_SESSION["username"];
						// Mencegah redeclare function GetNama
						if (!function_exists('GetNama')) {
						 function GetNama($username)
        					{
            					print $username;
        					}
						}
			          ?></b>
			<br>
			</b> Anda telah login sebagai <b><?php echo $_SESSION['level']; 
						 $level = $_SESSION["level"];
						// Mencegah redeclare function GetLevel
						if (!function_exists('GetLevel')) {
						 function GetLevel($level)
        					{
            					print $level;
        					}
						}
			          ?></b>.
	  </p>
        </p>
				
        <div class="logout-button">
            <a href="logout.php"> 
                <b> Logout </b>
            </a>
        </div>
    </div>
	    <div class="horizontal-menu">
        <img src="./assets/logo-udinus.png" alt="profile">
        <div class="nama">
            <h2><?php getNama($username) ?></h2>
            <h6><?php getLevel($level) ?></h6>
        </div>
        <ul>
            <li><a href="halaman_admin.php">Home</a></li>
            <li><a href="manage_user.php">Manage User</a></li>
            <li><a href="manage_dokter.php">Manage Dokter</a></li>
        </ul>
    </div>

<div style="margin-top:100px;margin-left:250px">
		<h4><a href="tambah_dokter.php">Tambah Data Dokter</a></h4>
        <table width="1027" style=" padding: 15px;">
            <tr style="background-color: #04AA6D;
                color: white;">
                <th>Id Dokter</th>
                <th>Nama Dokter</th>
                <th>Alamat</th>
				<th>No HP</th>	
				<th>ID Poli</th>	
				<th>Keterangan</th>	
                <th>Action</th>
            </tr>
            
                
                <?php 
				include "koneksi.php";
                $query = mysqli_query($connect ,"select * from dokter");
                    while($data=mysqli_fetch_array($query))
                        {
                            ?>
                            <tr>
                                    <td>
                                        <?php echo $data['id_dokter'];?>
                                    </td>
                                    <td>
                                        <?php echo $data['nama_dokter'];?>
                                    </td>
                                    <td>
                                        <?php echo $data['alamat_dokter']?>
                                    </td>
									<td>
                                        <?php echo $data['nohp_dokter'];?>
                                    </td>
                                    <td>
                                        <?php echo $data['id_poli'];?>
                                    </td>
                                    <td>
                                        <?php echo $data['keterangan_dokter'];?>
                                    </td>
                                    <td>
                                        <?php 
										echo "<a href='edit_dokter.php?id=".$data['id_dokter']."'>Edit||</a>";
										echo "<a href='hapus_dokter.php?id=".$data['id_dokter']."'>Hapus</a>";
										?>
                                    </td>
                            </tr>
                            <?php
                        }
                ?>
            
      </table>
    </div>
</body>
</html>