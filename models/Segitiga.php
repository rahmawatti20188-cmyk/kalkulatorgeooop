<?php
// models/Segitiga.php

// --- PERBAIKAN: Memastikan semua dependensi dimuat ---
require_once 'BangunDatar.php'; // Memuat Abstract Class (karena berada di folder models/ yang sama)
require_once __DIR__ . '/../interfaces/Calculable.php'; // Memuat Interface
require_once __DIR__ . '/../exceptions/SisiNegatifException.php'; // Memuat Custom Exception
// --------------------------------------------------------

class Segitiga extends BangunDatar implements Calculable {
    private $alas;
    private $tinggi;
    private $sisiA; // Untuk keliling
    private $sisiB;
    private $sisiC;

    // Asumsi konstruktor menerima alas, tinggi, dan 3 sisi untuk keliling
    public function __construct($alas, $tinggi, $sisiA, $sisiB, $sisiC) {
        parent::__construct("Segitiga");
        
        $alas = (float)$alas;
        $tinggi = (float)$tinggi;
        $sisiA = (float)$sisiA;
        $sisiB = (float)$sisiB;
        $sisiC = (float)$sisiC;

        // Contoh penanganan exception
        if ($alas <= 0 || $tinggi <= 0 || $sisiA <= 0 || $sisiB <= 0 || $sisiC <= 0) {
            throw new SisiNegatifException("Semua dimensi Segitiga harus positif.");
        }

        $this->alas = $alas;
        $this->tinggi = $tinggi;
        $this->sisiA = $sisiA;
        $this->sisiB = $sisiB;
        $this->sisiC = $sisiC;
    }

    public function hitungLuas() {
        // Luas Segitiga: 1/2 * alas * tinggi
        return 0.5 * $this->alas * $this->tinggi;
    }

    public function hitungKeliling() {
        // Keliling Segitiga: Sisi A + Sisi B + Sisi C
        return $this->sisiA + $this->sisiB + $this->sisiC;
    }
}