<?php
// models/Persegi.php

require_once 'BangunDatar.php';
require_once __DIR__ . '/../interfaces/Calculable.php';
require_once __DIR__ . '/../exceptions/SisiNegatifException.php';

class Persegi extends BangunDatar implements Calculable {
    private $sisi;

    public function __construct($sisi) {
        parent::__construct("Persegi");
        
        if ($sisi <= 0) {
            throw new SisiNegatifException("Nilai sisi harus positif untuk Persegi.");
        }
        $this->sisi = $sisi;
    }

    public function hitungLuas() {
        return $this->sisi * $this->sisi;
    }

    public function hitungKeliling() {
        return 4 * $this->sisi;
    }
}