<?php
// models/Lingkaran.php

require_once 'BangunDatar.php';
require_once __DIR__ . '/../interfaces/Calculable.php';
require_once __DIR__ . '/../exceptions/SisiNegatifException.php'; // Digunakan untuk Jari-jari < 0

class Lingkaran extends BangunDatar implements Calculable {
    private $jari_jari;
    private const PI = 3.1415926535; // Konstanta PI

    /**
     * Konstruktor untuk Lingkaran.
     * @param float $jari_jari
     * @throws SisiNegatifException Jika jari-jari <= 0.
     */
    public function __construct(float $jari_jari) {
        parent::__construct("Lingkaran");
        
        // Validasi, menggunakan Custom Exception yang sudah dibuat
        if ($jari_jari <= 0) {
            throw new SisiNegatifException("Nilai jari-jari harus positif untuk Lingkaran.");
        }

        $this->jari_jari = $jari_jari;
    }

    /**
     * Menghitung Luas Lingkaran: PI * r^2
     * @return float
     */
    public function hitungLuas() {
        return self::PI * pow($this->jari_jari, 2);
    }

    /**
     * Menghitung Keliling Lingkaran: 2 * PI * r
     * @return float
     */
    public function hitungKeliling() {
        return 2 * self::PI * $this->jari_jari;
    }
}