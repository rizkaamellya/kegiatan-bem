-- Migration 002: Add periode_tahun and semester to kegiatan table
ALTER TABLE `kegiatan` 
ADD COLUMN `periode_tahun` VARCHAR(20) NULL AFTER `tanggal`,
ADD COLUMN `semester` VARCHAR(20) NULL AFTER `periode_tahun`;

-- Update existing data default period
UPDATE `kegiatan` 
SET 
  `periode_tahun` = CASE 
    WHEN MONTH(tanggal) >= 7 THEN CONCAT(YEAR(tanggal), '/', YEAR(tanggal) + 1)
    ELSE CONCAT(YEAR(tanggal) - 1, '/', YEAR(tanggal))
  END,
  `semester` = CASE 
    WHEN MONTH(tanggal) >= 7 AND MONTH(tanggal) <= 12 THEN 'Ganjil'
    ELSE 'Genap'
  END
WHERE `periode_tahun` IS NULL OR `semester` IS NULL;
