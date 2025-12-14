<?php
// models/BangunModel.php (PASTIKAN KODE INI TERSIMPAN)

require_once 'Model.php';
require_once __DIR__ . '/../config/Database.php';

class BangunModel extends Model {
    private $table_name = "log_perhitungan";

    public function __construct(Database $db) {
        parent::__construct($db); 
    }
// models/BangunModel.php (di dalam protected function create)

protected function create(array $data) {
    // Kita gunakan syntax VALUES yang lebih aman untuk mencegah error (seperti yang disarankan sebelumnya)
    $query = "INSERT INTO " . $this->table_name . " 
              (nama_bangun, dimensi_input, luas_hasil, keliling_hasil, waktu_hitung) 
              VALUES 
              (:nama_bangun, :dimensi_input, :luas_hasil, :keliling_hasil, NOW())";

    $stmt = $this->db->prepare($query);

    // --- BAGIAN INI HARUS DITAMBAHKAN ---
    // Membersihkan data dan mengikat parameter (Binding Parameters)
    $stmt->bindParam(':nama_bangun', $data['nama_bangun']);
    $stmt->bindParam(':dimensi_input', $data['dimensi_input']);
    $stmt->bindParam(':luas_hasil', $data['luas_hasil']);
    $stmt->bindParam(':keliling_hasil', $data['keliling_hasil']);
    // ------------------------------------

    if($stmt->execute()) {
        return true;
    }

    return false;
}
    
public function simpanLog(string $bangun, string $dimensi, float $luas, float $keliling) {
        // ... (simpan log) ...
        $data = [
            'nama_bangun' => $bangun,
            'dimensi_input' => $dimensi,
            'luas_hasil' => $luas,
            'keliling_hasil' => $keliling
        ];
        return $this->create($data);
    }

    /**
     * Mengambil semua riwayat perhitungan dari database.
     * @return PDOStatement
     */
    public function readAll() {
        $query = "SELECT id, nama_bangun, dimensi_input, luas_hasil, keliling_hasil, waktu_hitung 
                  FROM " . $this->table_name . " 
                  ORDER BY waktu_hitung DESC"; // Mengurutkan dari yang terbaru

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt; 
    }

    // Implementasi wajib dari Abstract Model
    protected function read(int $id) { /* ... */ }
    protected function update(int $id, array $data) { /* ... */ }
    protected function delete(int $id) { /* ... */ }
}