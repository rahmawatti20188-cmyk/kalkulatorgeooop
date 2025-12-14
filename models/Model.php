<?php
// models/Model.php (VERSI PERBAIKAN)

abstract class Model {
    protected $db; // Instance koneksi database (PDO)

    public function __construct(Database $db) {
        $this->db = $db->getConnection(); // Asumsi Database::getConnection() mengembalikan objek PDO
    }

    // Metode abstrak yang harus diimplementasikan oleh model turunan (misal: CRUD)
    abstract protected function create(array $data);
    abstract protected function read(int $id);
    abstract protected function update(int $id, array $data);
    abstract protected function delete(int $id);
    
    // PERBAIKAN: Mengganti tipe data $dimensi dari float menjadi string
    abstract public function simpanLog(string $bangun, string $dimensi, float $luas, float $keliling);
}