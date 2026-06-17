<?php
// Memanggil koneksi database
require_once 'koneksi/database.php';

// Memanggil class tiket
require_once 'tiket_regular.php';
require_once 'tiket_IMAX.php';
require_once 'tiket_Velvet.php';

// ==========================================
// LOGIKA UNTUK MENYIMPAN PESANAN BARU (INSERT)
// ==========================================
if (isset($_POST['pesan_tiket'])) {
    $tipe_studio = $_POST['tipe_studio']; // Akan berisi REG, IMX, atau VLV
    $nama_film = $_POST['nama_film'];
    $jadwal_tayang = $_POST['jadwal_tayang'];
    $jumlah_kursi = $_POST['jumlah_kursi'];
    $harga_dasar = $_POST['harga_dasar'];

    // Membuat ID Tiket otomatis berdasarkan tipe studio + angka acak
    $id_tiket = $tipe_studio . "-" . rand(100, 999);

    // Query untuk menyimpan ke database
    $queryInsert = "INSERT INTO tabel_tiket (id_tiket, nama_film, jadwal_tayang, jumlah_kursi, harga_dasar_tiket) 
                    VALUES ('$id_tiket', '$nama_film', '$jadwal_tayang', '$jumlah_kursi', '$harga_dasar')";
    
    if ($koneksi->query($queryInsert) === TRUE) {
        echo "<script>alert('Tiket berhasil dipesan!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $queryInsert . "<br>" . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Tiket Bioskop</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; margin: 20px; }
        h1, h2 { text-align: center; color: #333; }
        
        /* Form Styling */
        .form-container { background: white; max-width: 500px; margin: 0 auto 30px auto; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; }
        .form-group input, .form-group select { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        .btn-submit { background-color: #28a745; color: white; border: none; padding: 10px 15px; width: 100%; font-size: 16px; border-radius: 4px; cursor: pointer; }
        .btn-submit:hover { background-color: #218838; }

        /* Card Styling (dari kode sebelumnya) */
        .container { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; }
        .kategori { background: white; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 30%; padding: 20px; min-width: 250px; }
        .kategori h2 { border-bottom: 2px solid #007BFF; padding-bottom: 10px; color: #007BFF; }
        .tiket-card { border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 5px; background-color: #fafafa; }
        .harga { font-size: 18px; color: #28a745; margin-top: 10px; }
        .fasilitas { margin-top: 10px; font-size: 14px; color: #555; background: #e9ecef; padding: 10px; border-radius: 4px; }
    </style>
</head>
<body>

    <h1>Aplikasi Bioskop</h1>

    <div class="form-container">
        <h2>Pesan Tiket Baru</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label>Pilih Studio:</label>
                <select name="tipe_studio" required>
                    <option value="REG">Studio Regular</option>
                    <option value="IMX">Studio IMAX</option>
                    <option value="VLV">Studio Velvet</option>
                </select>
            </div>
            <div class="form-group">
                <label>Nama Film:</label>
                <input type="text" name="nama_film" required placeholder="Contoh: Spider-Man">
            </div>
            <div class="form-group">
                <label>Jadwal Tayang:</label>
                <input type="datetime-local" name="jadwal_tayang" required>
            </div>
            <div class="form-group">
                <label>Jumlah Kursi:</label>
                <input type="number" name="jumlah_kursi" min="1" required>
            </div>
            <div class="form-group">
                <label>Harga Dasar Tiket (Rp):</label>
                <input type="number" name="harga_dasar" required placeholder="Contoh: 40000">
            </div>
            <button type="submit" name="pesan_tiket" class="btn-submit">Pesan Sekarang</button>
        </form>
    </div>

    <hr>
    <h2>Daftar Tiket Terpesan</h2>
    <div class="container">

        <div class="kategori">
            <h2>Studio Regular</h2>
            <?php
            $queryRegular = "SELECT * FROM tabel_tiket WHERE id_tiket LIKE 'REG%'"; 
            $resultRegular = $koneksi->query($queryRegular);

            if ($resultRegular->num_rows > 0) {
                while($row = $resultRegular->fetch_assoc()) {
                    $tiketReg = new TiketRegular($row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], $row['jumlah_kursi'], $row['harga_dasar_tiket'], "Dolby Digital", "Baris Tengah");
                    
                    echo "<div class='tiket-card'>";
                    echo "<strong>ID Tiket:</strong> " . $tiketReg->getIdTiket() . "<br>";
                    echo "<strong>Film:</strong> " . $tiketReg->getNamaFilm() . "<br>";
                    echo "<strong>Kursi:</strong> " . $tiketReg->getJumlahKursi() . "<br>";
                    echo "<div class='fasilitas'>"; $tiketReg->tampilkanInfoFasilitas(); echo "</div>";
                    echo "<div class='harga'><b>Total: Rp " . number_format($tiketReg->hitungTotalHarga(), 0, ',', '.') . "</b></div>";
                    echo "</div>";
                }
            } else { echo "<p>Belum ada pemesanan.</p>"; }
            ?>
        </div>

        <div class="kategori">
            <h2>Studio IMAX</h2>
            <?php
            $queryIMAX = "SELECT * FROM tabel_tiket WHERE id_tiket LIKE 'IMX%'"; 
            $resultIMAX = $koneksi->query($queryIMAX);

            if ($resultIMAX->num_rows > 0) {
                while($row = $resultIMAX->fetch_assoc()) {
                    $tiketIMX = new TiketIMAX($row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], $row['jumlah_kursi'], $row['harga_dasar_tiket'], "KCM-3D-VIP", "Active Motion Seat");
                    
                    echo "<div class='tiket-card'>";
                    echo "<strong>ID Tiket:</strong> " . $tiketIMX->getIdTiket() . "<br>";
                    echo "<strong>Film:</strong> " . $tiketIMX->getNamaFilm() . "<br>";
                    echo "<strong>Kursi:</strong> " . $tiketIMX->getJumlahKursi() . "<br>";
                    echo "<div class='fasilitas'>"; $tiketIMX->tampilkanInfoFasilitas(); echo "</div>";
                    echo "<div class='harga'><b>Total: Rp " . number_format($tiketIMX->hitungTotalHarga(), 0, ',', '.') . "</b></div>";
                    echo "</div>";
                }
            } else { echo "<p>Belum ada pemesanan.</p>"; }
            ?>
        </div>

        <div class="kategori">
            <h2>Studio Velvet</h2>
            <?php
            $queryVelvet = "SELECT * FROM tabel_tiket WHERE id_tiket LIKE 'VLV%'"; 
            $resultVelvet = $koneksi->query($queryVelvet);

            if ($resultVelvet->num_rows > 0) {
                while($row = $resultVelvet->fetch_assoc()) {
                    $tiketVlv = new TiketVelvet($row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], $row['jumlah_kursi'], $row['harga_dasar_tiket'], "Premium Bed Setup", "Tersedia");
                    
                    echo "<div class='tiket-card'>";
                    echo "<strong>ID Tiket:</strong> " . $tiketVlv->getIdTiket() . "<br>";
                    echo "<strong>Film:</strong> " . $tiketVlv->getNamaFilm() . "<br>";
                    echo "<strong>Kursi:</strong> " . $tiketVlv->getJumlahKursi() . "<br>";
                    echo "<div class='fasilitas'>"; $tiketVlv->tampilkanInfoFasilitas(); echo "</div>";
                    echo "<div class='harga'><b>Total: Rp " . number_format($tiketVlv->hitungTotalHarga(), 0, ',', '.') . "</b></div>";
                    echo "</div>";
                }
            } else { echo "<p>Belum ada pemesanan.</p>"; }
            ?>
        </div>

    </div>

</body>
</html>

<?php
$koneksi->close();
?>