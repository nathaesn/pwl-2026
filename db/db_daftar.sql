CREATE TABLE daftar (
id_daftar INT AUTO_INCREMENT PRIMARY KEY,
id_pasien INT NOT NULL,
id_dokter INT NOT NULL,
tanggal_periksa DATE NOT NULL,
nomor_antrian INT NOT NULL,
status_periksa ENUM(
'menunggu',
'selesai',
'batal')
DEFAULT 'menunggu',
waktu_daftar TIMESTAMP
DEFAULT CURRENT_TIMESTAMP
);
