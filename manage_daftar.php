<!DOCTYPE html>
<html>
<head>
	<title>Halaman Dokter</title>
	<link rel="stylesheet" href="css/style_sheet.css">
	<link rel="stylesheet" href="css/style_katalog_kanan.css">
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
	<!--
	<h1>Halaman Admin</h1>

	<p>Halo <b><?php echo $_SESSION['username']; ?></b> Anda telah login sebagai <b><?php echo $_SESSION['level']; ?></b>.</p>
	<a href="logout.php">LOGOUT</a>

	<br/>
	<br/>

	<a><a href="https://www.malasngoding.com/membuat-login-multi-user-level-dengan-php-dan-mysqli">Membuat Login Multi Level Dengan PHP</a> - www.malasngoding.com</a>
	-->
	
	    <div class="top-left">
        <img src="./assets/logo-udinus.png" alt="logo-udinus">
        <p class="title">
            POLY
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
            <li><a href="halaman_pasien.php">Home</a></li>
            <li><a href="manage_pasien.php">Manage Pasien</a></li>
			<li><a href="manage_daftar.php">Manage Daftar</a></li>
			<li><a href="manage_antrian.php">Manage Antrian</a></li>
        </ul>
    </div>

    <div style="margin-top:100px;margin-left:250px">
		<h4>Daftar Dokter Poliklinik</a></h4>
		<div class="katalog">
		<?php 
			include "koneksi.php";
            $query = mysqli_query($connect ,"SELECT dokter.id_dokter, dokter.foto_dokter, dokter.nama_dokter, poli.nama_poli FROM dokter, poli WHERE dokter.id_poli=poli.id_poli AND dokter.keterangan_dokter='Ada'");
                    while($data=mysqli_fetch_array($query))
                    {
					?>
					
					<div class="card">

						<img src="foto/<?php echo $data['foto_dokter'];?>" class="foto-dokter" alt="foto dokter">

						<div class="info">

							<div class="nama">

								<?php
									echo $data['nama_dokter'];
								?>

							</div>

							<div class="poli">

								Poli :
								<b>
									<?php echo $data['nama_poli'];?>
								</b>

							</div>

							<div class="status">

								Tersedia

							</div>

							<?php
							echo "
							<a href='#' class='btn' onclick='showConfirmModal(".$data['id_dokter'].")'>
							Daftar Periksa
							</a>
							";
							?>

						</div>

					</div>

					<?php
						}
					?>
			</div>
	</div>
					
	<!-- Modal Background -->
	<div id="customModal" class="modal-bg">
		<div class="modal-content">
			<h3 id="modalTitle">Konfirmasi</h3>
			<p id="modalText">Apakah Anda yakin ingin mendaftar pemeriksaan?</p>
			<div class="modal-actions">
				<a href="#" id="modalCancelBtn" class="btn-cancel" onclick="closeModal()">Batal</a>
				<a href="#" id="modalActionBtn" class="btn-confirm">Ya, Daftar</a>
			</div>
		</div>
	</div>

	<style>
		/* Custom Modal CSS */
		.modal-bg {
			display: none; 
			position: fixed; 
			z-index: 9999; 
			left: 0; 
			top: 0; 
			width: 100%; 
			height: 100%; 
			background-color: rgba(0,0,0,0.5); 
			justify-content: center; 
			align-items: center;
		}
		.modal-content {
			background-color: #fff; 
			padding: 20px 30px; 
			border-radius: 8px; 
			width: 350px; 
			text-align: center;
			box-shadow: 0 4px 8px rgba(0,0,0,0.2);
			animation: slideDown 0.3s ease-out;
		}
		@keyframes slideDown {
			from { transform: translateY(-50px); opacity: 0; }
			to { transform: translateY(0); opacity: 1; }
		}
		.modal-content h3 {
			margin-top: 0;
			color: #333;
		}
		.modal-actions {
			margin-top: 20px;
			display: flex;
			justify-content: space-around;
		}
		.modal-actions a {
			text-decoration: none;
			padding: 8px 15px;
			border-radius: 4px;
			color: #fff;
			font-weight: bold;
		}
		.btn-cancel {
			background-color: #f44336;
		}
		.btn-cancel:hover {
			background-color: #da190b;
		}
		.btn-confirm {
			background-color: #04AA6D;
		}
		.btn-confirm:hover {
			background-color: #038857;
		}
		.btn-ok {
			background-color: #2196F3;
			display: none;
		}
		.btn-ok:hover {
			background-color: #0b7dda;
		}
	</style>

	<script>
		// Modal Logic
		const modal = document.getElementById('customModal');
		const modalTitle = document.getElementById('modalTitle');
		const modalText = document.getElementById('modalText');
		const actionBtn = document.getElementById('modalActionBtn');
		const cancelBtn = document.getElementById('modalCancelBtn');

		function showConfirmModal(idDokter) {
			modalTitle.innerText = "Konfirmasi Pendaftaran";
			modalText.innerText = "Apakah Anda yakin ingin mendaftar pemeriksaan di dokter ini?";
			actionBtn.innerText = "Ya, Daftar";
			actionBtn.style.display = "inline-block";
			actionBtn.href = "proses_daftar.php?id_dokter=" + idDokter;
			actionBtn.className = "btn-confirm";
			cancelBtn.style.display = "inline-block";
			
			modal.style.display = "flex";
		}

		function showInfoModal(title, text) {
			modalTitle.innerText = title;
			modalText.innerText = text;
			actionBtn.style.display = "none";
			cancelBtn.innerText = "Tutup";
			cancelBtn.className = "btn-confirm"; // ganti warna agar hijau
			modal.style.display = "flex";
		}

		function closeModal() {
			modal.style.display = "none";
		}

		// Close modal if clicked outside
		window.onclick = function(event) {
			if (event.target == modal) {
				closeModal();
			}
		}

		<?php
		// Check for message in URL logic
		if(isset($_GET['pesan'])){
			if($_GET['pesan'] == "berhasil"){
				$no = $_GET['nomor'];
				echo "showInfoModal('Pendaftaran Berhasil', 'Anda berhasil mendaftar.\\nNomor Antrian: $no');";
			} else if($_GET['pesan'] == "penuh"){
				echo "showInfoModal('Antrian Penuh', 'Maaf, kuota antrian untuk hari ini sudah penuh.');";
			}
		}
		?>
	</script>

</body>
</html>