<?php
// config/Database.php

class Database {
    private $host = 'localhost';
    private $db_name = 'kalkulator_geometri'; // PASTIKAN NAMA INI SAMA DENGAN DB ANDA
    private $username = 'root'; 
    private $password = '';     // KOSONGKAN JIKA DEFAULT XAMPP/WAMP
    private $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
            
        } catch(PDOException $exception) {
            // TAMPILKAN ERROR KONEKSI SECARA PAKSA!
            echo "<h1>🔴 FATAL ERROR KONEKSI DATABASE:</h1>";
            echo "<p>" . $exception->getMessage() . "</p>";
            exit(); // MATIKAN SCRIPT
        }
        return $this->conn;
    }
}