<?php
// controllers/GeometriController.php

require_once __DIR__ . '/../interfaces/ErrorHandler.php';
require_once __DIR__ . '/../exceptions/SisiNegatifException.php'; 
require_once __DIR__ . '/../exceptions/DimensiTidakLengkapException.php'; 
// Include semua models YANG TELAH DITAMBAHKAN
require_once __DIR__ . '/../models/Persegi.php';
require_once __DIR__ . '/../models/PersegiPanjang.php';
require_once __DIR__ . '/../models/Lingkaran.php'; // <--- BARU
require_once __DIR__ . '/../models/Segitiga.php'; // <--- BARU

class GeometriController implements ErrorHandler {
    private $logModel; // Instance BangunModel untuk menyimpan log

    public function __construct(BangunModel $logModel) {
        $this->logModel = $logModel;
    }
    
    // ... (Metode prosesPerhitungan tetap sama) ...
    public function prosesPerhitungan($bangun, $dimensi) {
        try {
            if (empty($bangun) || empty($dimensi)) {
                throw new DimensiTidakLengkapException("Jenis bangun atau dimensi tidak boleh kosong.");
            }

            $hasil = $this->buatDanHitungBangun($bangun, $dimensi);

            // Simpan log perhitungan
            $this->logModel->simpanLog(
                $hasil['nama'], 
                json_encode($dimensi), 
                $hasil['luas'], 
                $hasil['keliling']
            );
            
            return $hasil;

        } catch (Exception $e) {
            return $this->handleError($e);
        }
    }

    /**
     * Factory Method untuk membuat objek bangun datar.
     */
    private function buatDanHitungBangun($jenis, $params) {
        $bangunObj = null;
        
        switch ($jenis) {
            case 'persegi':
                if (!isset($params['sisi'])) {
                    throw new DimensiTidakLengkapException("Sisi Persegi harus diisi.");
                }
                $bangunObj = new Persegi($params['sisi']);
                break;
            case 'persegipanjang':
                if (!isset($params['panjang']) || !isset($params['lebar'])) {
                    throw new DimensiTidakLengkapException("Panjang dan Lebar Persegi Panjang harus diisi.");
                }
                $bangunObj = new PersegiPanjang($params['panjang'], $params['lebar']);
                break;
            
            case 'lingkaran': // KASUS LINGKARAN
                if (!isset($params['jari_jari'])) {
                    throw new DimensiTidakLengkapException("Jari-jari Lingkaran harus diisi.");
                }
                $bangunObj = new Lingkaran($params['jari_jari']);
                break;
                
            case 'segitiga': // KASUS SEGITIGA
                if (!isset($params['alas']) || !isset($params['tinggi']) || 
                    !isset($params['sisiA']) || !isset($params['sisiB']) || !isset($params['sisiC'])) {
                    throw new DimensiTidakLengkapException("Alas, Tinggi, dan ketiga sisi (A, B, C) Segitiga harus diisi.");
                }
                $bangunObj = new Segitiga(
                    $params['alas'], 
                    $params['tinggi'], 
                    $params['sisiA'], 
                    $params['sisiB'], 
                    $params['sisiC']
                );
                break;
                
            default:
                throw new Exception("Jenis bangun '$jenis' tidak dikenal.");
        }

        return [
            'nama' => $bangunObj->getNama(), 
            'luas' => $bangunObj->hitungLuas(),
            'keliling' => $bangunObj->hitungKeliling()
        ];
    }
    
    // ... (Metode handleError tetap sama) ...
    public function handleError(Exception $e) {
        $error = [
            'status' => 'error',
            'message' => 'Terjadi kesalahan sistem.',
            'detail' => $e->getMessage()
        ];

        if ($e instanceof SisiNegatifException) {
            $error['message'] = $e->getCustomErrorMessage();
        } elseif ($e instanceof DimensiTidakLengkapException) {
            $error['message'] = "Input Tidak Lengkap: " . $e->getMessage();
        }
        
        error_log("GEOMETRI ERROR: " . $e->getMessage());
        
        return $error;
    }
}