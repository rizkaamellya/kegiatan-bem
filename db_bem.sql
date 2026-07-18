CREATE DATABASE IF NOT EXISTS db_bem
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE db_bem;

CREATE TABLE IF NOT EXISTS admin (
  id_admin INT UNSIGNED NOT NULL AUTO_INCREMENT,
  username VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  PRIMARY KEY (id_admin),
  UNIQUE KEY uq_admin_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Akun admin awal: username admin, password admin123
INSERT IGNORE INTO admin (username, password) VALUES
  ('admin', '$2y$10$7RpxuxTTW.hC1vXpfC.MpOw30.jEZRm1b.omIYyFTGWBFRwv7Ug1q');

CREATE TABLE IF NOT EXISTS kegiatan (
  id_kegiatan INT UNSIGNED NOT NULL AUTO_INCREMENT,
  nama_kegiatan VARCHAR(150) NOT NULL,
  tanggal DATE NOT NULL,
  lokasi VARCHAR(150) DEFAULT NULL,
  foto VARCHAR(255) DEFAULT NULL,
  deskripsi MEDIUMTEXT DEFAULT NULL,
  PRIMARY KEY (id_kegiatan)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS kepanitiaan (
  id_kepanitiaan INT UNSIGNED NOT NULL AUTO_INCREMENT,
  id_kegiatan INT UNSIGNED NOT NULL,
  nama_panitia VARCHAR(150) NOT NULL,
  jabatan VARCHAR(100) NOT NULL,
  PRIMARY KEY (id_kepanitiaan),
  KEY idx_kepanitiaan_id_kegiatan (id_kegiatan),
  CONSTRAINT fk_kepanitiaan_kegiatan
    FOREIGN KEY (id_kegiatan)
    REFERENCES kegiatan (id_kegiatan)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS keuangan (
  id_keuangan INT UNSIGNED NOT NULL AUTO_INCREMENT,
  id_kegiatan INT UNSIGNED NOT NULL,
  keterangan VARCHAR(255) NOT NULL,
  jumlah INT NOT NULL DEFAULT 0,
  harga DECIMAL(15,2) NOT NULL DEFAULT 0.00,
  tanggal DATE NOT NULL,
  PRIMARY KEY (id_keuangan),
  KEY idx_keuangan_id_kegiatan (id_kegiatan),
  CONSTRAINT fk_keuangan_kegiatan
    FOREIGN KEY (id_kegiatan)
    REFERENCES kegiatan (id_kegiatan)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
