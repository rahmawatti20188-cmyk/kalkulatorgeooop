-- File: SQL.sql
-- Digunakan untuk membuat database dan tabel log perhitungan kalkulator geometri OOP.

-- 1. Buat Database
CREATE DATABASE IF NOT EXISTS kalkulator_geometri;
USE kalkulator_geometri;

-- 2. Buat Tabel Log Perhitungan
CREATE TABLE IF NOT EXISTS log_perhitungan (
    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nama_bangun VARCHAR(50) NOT NULL COMMENT 'Contoh: Persegi, Lingkaran, Segitiga',
    dimensi_input TEXT NOT NULL COMMENT 'Input dimensi (contoh: {"sisi": 10} atau {"panjang": 5, "lebar": 8})',
    luas_hasil DECIMAL(10, 4) NULL,
    keliling_hasil DECIMAL(10, 4) NULL,
    waktu_hitung DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Contoh Data (Opsional, untuk pengujian)
INSERT INTO log_perhitungan (nama_bangun, dimensi_input, luas_hasil, keliling_hasil) VALUES 
('Persegi', '{"sisi": 10}', 100.00, 40.00),
('Lingkaran', '{"jari_jari": 7}', 153.9380, 43.9823),
('Persegi Panjang', '{"panjang": 5, "lebar": 8}', 40.00, 26.00);

-- Query untuk melihat log terbaru
-- SELECT * FROM log_perhitungan ORDER BY waktu_hitung DESC;