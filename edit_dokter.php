<!DOCTYPE html>
<html>
<head>
	<title>Halaman Admin - Edit Dokter</title>
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
        <p class="title">POLIKLINIK</p>
        <p class="define">Clinic Universitas Dian Nuswantoro</p>
    </div>
    <div class="top-right">
        <p class="page-title">
      <p> 
			<b>Halaman Admin</b><br>
			Halo : <b><?php echo $_SESSION['username']; 
			 			$username = $_SESSION["username"];
						if (!function_exists('GetNama')) {
						 function GetNama($username) { print $username; }
						}
			          ?></b><br>
			</b> Anda telah login sebagai <b><?php echo $_SESSION['level']; 
						 $level = $_SESSION["level"];
						if (!function_exists('GetLevel')) {
						 function GetLevel($level) { print $level; }
						}
			          ?></b>.
	  </p>
        </p>
        <div class="logout-button">
            <a href="logout.php"><b>Logout</b></a>
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
	<?php
	// Getting id from url
	include "koneksi.php";
	$id = $_GET['id'];
	 
	// Fetech user data based on id
	$query="SELECT dokter.*, poli.nama_poli FROM dokter JOIN poli ON dokter.id_poli = poli.id_poli WHERE id_dokter='$id'";
	$sql = mysqli_query($connect,$query);
	 
	while($data = mysqli_fetch_array($sql))
	{
	    $id_dokter = $data['id_dokter'];
		$nama_dokter = $data['nama_dokter'];
	    $alamat_dokter = $data['alamat_dokter'];
		$nohp_dokter = $data['nohp_dokter'];
		$id_poli = $data['id_poli'];
		$nama_poli = $data['nama_poli'];
		$keterangan_dokter = $data['keterangan_dokter'];
		$foto = $data['foto_dokter'];
	}
	?>
	<div class="kotak_login" style="margin-top: 50px;">
		<p class="tulisan_login">Update Dokter</p>
		<form action="update_dokter.php" method="post" enctype="multipart/form-data">
			<label>Identitas Dokter (ID)</label>	
			<input type="text" name="id_dokter" class="form_login" required="required" value="<?php echo $id_dokter;?>" readonly>
		
			<label>Nama Dokter</label>
			<input type="text" name="nama_dokter" class="form_login" placeholder="Nama Dokter.." required="required" value="<?php echo $nama_dokter;?>">
			
			<label>Alamat Dokter</label>
			<input type="text" name="alamat_dokter" class="form_login" placeholder="Alamat Dokter .." required="required" value="<?php echo $alamat_dokter;?>">
 			
			<label>No HP Dokter</label>
			<input type="text" name="nohp_dokter" class="form_login" placeholder="No HP Dokter .." required="required" value="<?php echo $nohp_dokter;?>">
			
			<label>Keterangan</label>
			<br>
			<select name="keterangan_dokter" id="keterangan_dokter" class="form_login">
			  <option value="Ada" <?php if($keterangan_dokter == 'Ada') echo 'selected'; ?>>Ada</option>
			  <option value="Tidak" <?php if($keterangan_dokter == 'Tidak') echo 'selected'; ?>>Tidak</option>
		    </select>

			<label>Identitas Poli</label>
			<br>
			<select name="id_poli" id="id_poli" class="form_login" onChange="tampilPoli()" required>
        			<?php
        				$sql_poli = "SELECT * FROM poli";
        				$result_poli = mysqli_query($connect, $sql_poli);
        				while ($row = mysqli_fetch_assoc($result_poli)) {
							$selected = ($row['id_poli'] == $id_poli) ? 'selected' : '';
            				echo "<option value='".$row['id_poli']."' data-nama='".$row['nama_poli']."' $selected>"
                    		.$row['id_poli']." - ".$row['nama_poli'].
                 			"</option>";
        				}
        			?>
		    </select>

			<label>Nama Poli</label>
			<input type="text" name="nama_poli" class="form_login" id="nama_poli" readonly value="<?php echo $nama_poli; ?>">

			<label>Foto Dokter</label>
			<br>
			<!-- Tampilkan foto lama jika ada -->
			<?php if($foto != ""){ ?>
				<img src="foto/<?php echo $foto; ?>" width="100" height="100" style="margin-bottom:10px;"><br>
			<?php } ?>
			<!-- Input foto baru opsional -->
			<input type="file" name="foto_dokter" accept="image/*" onChange="previewFoto(event)">
			<i style="color:grey; font-size:12px;">(Abaikan jika tidak ingin merubah foto)</i>
			<br><br>
			<img id="preview" width="100" height="100" style="display:none; margin-bottom:10px;">
			
			<input type="submit" class="tombol_login" value="UPDATE" style="background-color: #04AA6D;">
			<br/>
		</form>
	</div>

	<script>
		function tampilPoli() {
			var select = document.getElementById('id_poli');
			var selectedOption = select.options[select.selectedIndex];
			var namaPoli = selectedOption.getAttribute('data-nama');
			
			document.getElementById('nama_poli').value = namaPoli ? namaPoli : '';
		}

		function previewFoto(event) {
			var reader = new FileReader();
			reader.onload = function() {
				var output = document.getElementById('preview');
				output.src = reader.result;
				output.style.display = 'block';
			};
			if (event.target.files[0]) {
				reader.readAsDataURL(event.target.files[0]);
			}
		}
	</script>
</body>
</html>