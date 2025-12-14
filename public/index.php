<?php
// public/index.php - Entry Point & View (FINAL DAN BEBAS WARNING)

// 1. TANGANI OUTPUT BUFFERING
ob_start();

// 2. AKTIFKAN ERROR REPORTING
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 3. DEFINISIKAN PATH AKAR PROYEK
define('ROOT_PATH', __DIR__ . '/../');

// 4. LOAD SEMUA YANG DIBUTUHKAN 
require_once __DIR__ . '/../config/Database.php';    
require_once __DIR__ . '/../models/Model.php';      
require_once __DIR__ . '/../models/BangunDatar.php'; 
require_once __DIR__ . '/../models/BangunModel.php'; 
require_once __DIR__ . '/../controllers/GeometriController.php';

// 5. INISIASI & HILANGKAN WARNING
$db = new Database(); 
$logModel = new BangunModel($db);
$controller = new GeometriController($logModel);

$hasil = null;
$error = null;
$jenis_bangun = null; // Menghilangkan Warning: Undefined variable pada load pertama
$logStmt = $logModel->readAll();
$log_history = $logStmt->fetchAll(PDO::FETCH_ASSOC);

// 6. TANGANI INPUT POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hitung'])) {
    $jenis_bangun = $_POST['jenis_bangun'] ?? null;
    $dimensi = $_POST['dimensi'] ?? [];

    $response = $controller->prosesPerhitungan($jenis_bangun, $dimensi);

    if (isset($response['status']) && $response['status'] === 'error') {
        $error = $response;
    } else {
        $hasil = $response;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kalkulator Geometri OOP</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="number"], select { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ddd; border-radius: 4px; }
        button { padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .result, .error { margin-top: 20px; padding: 15px; border-radius: 4px; }
        .result { background-color: #e6ffed; border: 1px solid #c3e6cb; }
        .error { background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
        #input-dimensi div { margin-bottom: 10px; }
    </style>
</head>
<body>

<div class="container">
    <h1>📐 Kalkulator Bangun Datar OOP</h1>
    
    <?php if ($error): ?>
        <div class="error">
            <strong>❌ Error Perhitungan:</strong> <?php echo htmlspecialchars($error['message']); ?><br>
            <small>Detail: <?php echo htmlspecialchars($error['detail']); ?></small>
        </div>
    <?php elseif ($hasil): ?>
        <div class="result">
            <strong>✅ Hasil Perhitungan (<?php echo htmlspecialchars($hasil['nama']); ?>)</strong>
            <p>Luas: <strong><?php echo number_format($hasil['luas'], 4); ?></strong></p>
            <p>Keliling: <strong><?php echo number_format($hasil['keliling'], 4); ?></strong></p>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php">
        <div class="form-group">
            <label for="jenis_bangun">Pilih Bangun Datar:</label>
            <select name="jenis_bangun" id="jenis_bangun" required onchange="tampilkanInput()">
                <option value="" disabled selected>-- Pilih Bangun --</option>
                <option value="persegi">Persegi</option>
                <option value="persegipanjang">Persegi Panjang</option>
                <option value="lingkaran">Lingkaran</option>
                <option value="segitiga">Segitiga</option>
            </select>
        </div>

        <div id="input-dimensi">
        </div>

        <button type="submit" name="hitung">Hitung Luas & Keliling</button>
    </form>
</div>

<div class="container" style="margin-top: 30px;">
    <h2>⏳ Riwayat Perhitungan (Log)</h2>
    
    <?php if (empty($log_history)): ?>
        <p>Belum ada riwayat perhitungan yang tersimpan.</p>
    <?php else: ?>
        <table border="1" style="width: 100%; border-collapse: collapse; margin-top: 15px; font-size: 0.9em;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>ID</th>
                    <th>Bangun</th>
                    <th>Dimensi (JSON)</th>
                    <th>Luas</th>
                    <th>Keliling</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($log_history as $log): ?>
                <tr>
                    <td><?php echo htmlspecialchars($log['id']); ?></td>
                    <td><?php echo htmlspecialchars($log['nama_bangun']); ?></td>
                    <td><small><?php echo htmlspecialchars($log['dimensi_input']); ?></small></td>
                    <td><?php echo number_format($log['luas_hasil'], 4); ?></td>
                    <td><?php echo number_format($log['keliling_hasil'], 4); ?></td>
                    <td><?php echo htmlspecialchars($log['waktu_hitung']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div> 

<script>
    // Logika JavaScript untuk mengubah input dimensi berdasarkan pilihan bangun
    function tampilkanInput() {
        const jenis = document.getElementById('jenis_bangun').value;
        const divInput = document.getElementById('input-dimensi');
        let htmlInput = '';

        if (jenis === 'persegi') {
            htmlInput = `
                <div><label>Sisi (s):</label><input type="number" name="dimensi[sisi]" step="any" required></div>
            `;
        } else if (jenis === 'persegipanjang') {
            htmlInput = `
                <div><label>Panjang (p):</label><input type="number" name="dimensi[panjang]" step="any" required></div>
                <div><label>Lebar (l):</label><input type="number" name="dimensi[lebar]" step="any" required></div>
            `;
        } else if (jenis === 'lingkaran') {
            htmlInput = `
                <div><label>Jari-jari (r):</label><input type="number" name="dimensi[jari_jari]" step="any" required></div>
            `;
        } else if (jenis === 'segitiga') {
            htmlInput = `
                <p><strong>Untuk Luas & Keliling:</strong></p>
                <div><label>Alas:</label><input type="number" name="dimensi[alas]" step="any" required></div>
                <div><label>Tinggi:</label><input type="number" name="dimensi[tinggi]" step="any" required></div>
                <p><strong>Input 3 Sisi untuk Keliling:</strong></p>
                <div><label>Sisi A:</label><input type="number" name="dimensi[sisiA]" step="any" required></div>
                <div><label>Sisi B:</label><input type="number" name="dimensi[sisiB]" step="any" required></div>
                <div><label>Sisi C:</label><input type="number" name="dimensi[sisiC]" step="any" required></div>
            `;
        }
        
        divInput.innerHTML = htmlInput;
    }
    
    // Tampilkan input dimensi saat halaman dimuat (untuk load pertama)
    tampilkanInput();

    // LOGIKA JAVASCRIPT UNTUK MENGINGAT OPSI YANG DIPILIH SETELAH POST
    (function() {
        // Ambil nilai $jenis_bangun dari PHP (yang diinisialisasi di awal script)
        const jenisTersimpan = "<?php echo $jenis_bangun ?? ''; ?>";
        
        if (jenisTersimpan) {
            document.getElementById('jenis_bangun').value = jenisTersimpan;
            tampilkanInput(); 
        }
    })();
</script>

</body>
</html>