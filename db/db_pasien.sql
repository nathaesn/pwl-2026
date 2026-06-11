CREATE TABLE pasien (
    id_pasien INT AUTO_INCREMENT PRIMARY KEY,
    nama_pasien VARCHAR(255) NOT NULL,
    alamat_pasien VARCHAR(255),
    noktp_pasien VARCHAR(20),
    nohp_pasien VARCHAR(20),
    norm_pasien VARCHAR(20)
);