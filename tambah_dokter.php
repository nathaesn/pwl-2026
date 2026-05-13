<!DOCTYPE html>
<html>
<head>
	<title>Halaman admin</title>
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
						 function GetNama($username)
        					{
            					print $username;
        					}
			          ?></b>
			<br>
			</b> Anda telah login sebagai <b><?php echo $_SESSION['level']; 
						 $level = $_SESSION["level"];
						 function GetLevel($level)
        					{
            					print $level;
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
            <li><a href="halaman_user.php">Home</a></li>
            <li><a href="manage_user.php">Manage User</a></li>
        </ul>
    </div>

<div class="kotak_login">
		<p class="tulisan_login">Tambah Dokter</p>
 
			<form action="save_dokter.php" method="post">
			<label>Nama Dokter</label>
			<input type="text" name="nama_dokter" class="form_login" placeholder="Nama Dokter .." required="required">
			
			<label>Alamat Dokter</label>
			<input type="text" name="alamat_dokter" class="form_login" placeholder="Alamat Dokter .." required="required">
 
			<label>No HP Dokter</label>
			<input type="text" name="nohp_dokter" class="form_login" placeholder="No HP Dokter .." required="required">
 
			<label>Keterangan</label>
			<br>
			<select name="keterangan_dokter" id="keterangan_dokter">
			  <option>--Pilih Keterangan--</option>
			  <option>Ada</option>
			  <option>Tidak</option>
		    </select>
			<br>
			<br>

			<label>Identitas Poli</label>
			<br>
			<select name="id_poli" id="id_poli" onChange="tampilPoli()" required>
       			<option value="">--Pilih Poli--</option>

        			<?php
						include("koneksi.php");
        				$sql = "SELECT * FROM poli";
        				$result = mysqli_query($connect, $sql);

        				while ($row = mysqli_fetch_assoc($result)) 
						{
            				echo "<option value='".$row['id_poli']."' data-nama='".$row['nama_poli']."'>"
                    		.$row['id_poli']." - ".$row['nama_poli'].
                 			"</option>";
        				}
        			?>
		  </select>
				<br>
				<br>
			<label>Nama Poli</label>
			<input type="text" name="nama_poli" class="form_login" id="nama_poli" readonly>
			
			<input type="submit" class="tombol_login" value="SAVE">
 
			<br/>

		</form>
		
	</div>
    </div>

	<script>
		function tampilPoli() {
			var select = document.getElementById('id_poli');
			var selectedOption = select.options[select.selectedIndex];
			var namaPoli = selectedOption.getAttribute('data-nama');
			
			// Set nilai pada input nama_poli, jika belum ada yang terpilih maka kosongkan
			document.getElementById('nama_poli').value = namaPoli ? namaPoli : '';
		}
	</script>
</body>
</html>