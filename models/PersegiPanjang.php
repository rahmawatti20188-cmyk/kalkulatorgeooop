<?php
// models/PersegiPanjang.php
// Pastikan untuk 'use' interface dan custom exception yang relevan
require_once 'BangunDatar.php';
require_once __DIR__ . '/../interfaces/Calculable.php';
require_once __DIR__ . '/../exceptions/SisiNegatifException.php'; 

class PersegiPanjang extends BangunDatar implements Calculable {
    private $panjang;
    private $lebar;

    public function __construct($panjang, $lebar) {
        parent::__construct("Persegi Panjang");
        
        // Contoh penanganan exception
        if ($panjang < 0 || $lebar < 0) {
            throw new SisiNegatifException("Panjang dan lebar tidak boleh negatif.");
        }

        $this->panjang = $panjang;
        $this->lebar = $lebar;
    }

    public function hitungLuas() {
        return $this->panjang * $this->lebar;
    }

    public function hitungKeliling() {
        return 2 * ($this->panjang + $this->lebar);
    }
}