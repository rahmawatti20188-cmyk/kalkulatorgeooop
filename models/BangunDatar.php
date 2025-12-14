<?php
// models/BangunDatar.php

abstract class BangunDatar
{
    protected $nama;
    
    // WAJIB: KEMBALIKAN CONSTRUCTOR UNTUK INISIALISASI $nama
    public function __construct(string $nama) {
        $this->nama = $nama;
    }
    
    // GETTER yang benar
    public function getNama() {
        return $this->nama;
    }

    abstract public function hitungLuas();
    abstract public function hitungKeliling();
}