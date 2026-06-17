<?php
// Memanggil koneksi dan semua class
require_once 'database.php';
require_once 'tiket_regular.php';
require_once 'tiket_IMAX.php';
require_once 'tiket_Velvet.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pemesanan Tiket Bioskop</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; margin: 20px; }
        h1 { text-align: center; color: #333; }
        .container { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; }
        .kategori { background: white; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 30%; padding: 20px; }
        .kategori h2 { border-bottom: 2px solid #007BFF; padding-bottom: 10px; color: #007BFF; }
        .tiket-card { border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 5px; background-color: #fafafa; }
        .harga { font-size: 18px; color: #28a745; margin-top: 10px; }
        .fasilitas { margin-top: 10px; font-size: 14px; color: #555; background: #e9ecef; padding: 10px; border-radius: 4px; }
    </style>
</head>
<body>

    <h1>Antarmuka Pemesanan Tiket Bioskop</h1>
    <div class="container">

        <div class="kategori">
            <h2>Studio Regular</h2>
            <?php
            // Query mengambil semua tiket Regular (awalan REG) tanpa JOIN
            $queryRegular = "SELECT * FROM tabel_tiket WHERE id_tiket LIKE 'REG%'"; 
            $resultRegular = $koneksi->query($queryRegular);

            if ($resultRegular->num_rows > 0) {
                while($row = $resultRegular->fetch_assoc()) {
                    // Instansiasi objek
                    $tiketReg = new TiketRegular($row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], $row['jumlah_kursi'], $row['harga_dasar_tiket'], "Dolby Digital", "Baris Tengah");
                    
                    echo "<div class='tiket-card'>";
                    echo "<strong>ID Tiket:</strong> " . $tiketReg->getIdTiket() . "<br>";
                    echo "<strong>Film:</strong> " . $tiketReg->getNamaFilm() . "<br>";
                    echo "<strong>Jadwal:</strong> " . $tiketReg->getJadwalTayang() . "<br>";
                    echo "<strong>Jumlah Kursi:</strong> " . $tiketReg->getJumlahKursi() . "<br>";
                    
                    echo "<div class='fasilitas'>";
                    // Pemanggilan metode polimorfik untuk fasilitas
                    $tiketReg->tampilkanInfoFasilitas(); 
                    echo "</div>";

                    // Pemanggilan metode polimorfik untuk total harga
                    echo "<div class='harga'><b>Total: Rp " . number_format($tiketReg->hitungTotalHarga(), 0, ',', '.') . "</b></div>";
                    echo "</div>";
                }
            } else {
                echo "<p>Belum ada pemesanan untuk Studio Regular.</p>";
            }
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
                    echo "<strong>Jadwal:</strong> " . $tiketIMX->getJadwalTayang() . "<br>";
                    echo "<strong>Jumlah Kursi:</strong> " . $tiketIMX->getJumlahKursi() . "<br>";
                    
                    echo "<div class='fasilitas'>";
                    $tiketIMX->tampilkanInfoFasilitas(); 
                    echo "</div>";

                    echo "<div class='harga'><b>Total: Rp " . number_format($tiketIMX->hitungTotalHarga(), 0, ',', '.') . "</b></div>";
                    echo "</div>";
                }
            } else {
                echo "<p>Belum ada pemesanan untuk Studio IMAX.</p>";
            }
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
                    echo "<strong>Jadwal:</strong> " . $tiketVlv->getJadwalTayang() . "<br>";
                    echo "<strong>Jumlah Kursi:</strong> " . $tiketVlv->getJumlahKursi() . "<br>";
                    
                    echo "<div class='fasilitas'>";
                    $tiketVlv->tampilkanInfoFasilitas(); 
                    echo "</div>";

                    echo "<div class='harga'><b>Total: Rp " . number_format($tiketVlv->hitungTotalHarga(), 0, ',', '.') . "</b></div>";
                    echo "</div>";
                }
            } else {
                echo "<p>Belum ada pemesanan untuk Studio Velvet.</p>";
            }
            ?>
        </div>

    </div>

</body>
</html>

<?php
// Tutup koneksi database di paling akhir
$koneksi->close();
?>