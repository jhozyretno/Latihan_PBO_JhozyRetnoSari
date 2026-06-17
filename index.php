<?php
// Memanggil koneksi database dari folder koneksi
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
    
    // Menitipkan kode studio ke nama film
    $nama_film = "[" . $tipe_studio . "] " . $_POST['nama_film']; 
    
    $jadwal_tayang = $_POST['jadwal_tayang'];
    $jumlah_kursi = $_POST['jumlah_kursi'];
    $harga_dasar = $_POST['harga_dasar'];

    // Query INSERT: id_tiket tidak dimasukkan agar database mengisinya otomatis secara urut (Auto Increment)
    $queryInsert = "INSERT INTO tabel_tiket (nama_film, jadwal_tayang, jumlah_kursi, harga_dasar_tiket) 
                    VALUES ('$nama_film', '$jadwal_tayang', '$jumlah_kursi', '$harga_dasar')";
    
    if ($koneksi->query($queryInsert) === TRUE) {
        echo "<script>alert('Tiket berhasil dipesan!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $koneksi->error . "');</script>";
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
        /* Mengubah font utama menjadi Times New Roman dan teks menjadi hitam */
        body { font-family: "Times New Roman", Times, serif; color: black; background-color: #f4ebfa; margin: 20px; } 
        h1, h2 { text-align: center; color: black; } 
        
        /* Form Styling */
        .form-container { background: white; max-width: 500px; margin: 0 auto 30px auto; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(106, 27, 154, 0.15); }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; color: black; }
        /* Memastikan input form juga menggunakan Times New Roman */
        .form-group input, .form-group select { font-family: "Times New Roman", Times, serif; width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ce93d8; border-radius: 4px; color: black; }
        
        /* Tombol Pesan (teks tetap putih agar terbaca jelas di atas warna ungu) */
        .btn-submit { font-family: "Times New Roman", Times, serif; background-color: #8e24aa; color: white; border: none; padding: 10px 15px; width: 100%; font-size: 16px; border-radius: 4px; cursor: pointer; transition: 0.3s; }
        .btn-submit:hover { background-color: #6a1b9a; } 

        /* Card Styling */
        .container { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; }
        .kategori { background: white; border-radius: 8px; box-shadow: 0 4px 8px rgba(106, 27, 154, 0.15); width: 30%; padding: 20px; min-width: 250px; }
        .kategori h2 { border-bottom: 2px solid #ab47bc; padding-bottom: 10px; color: black; } 
        .tiket-card { border: 1px solid #e1bee7; padding: 15px; margin-bottom: 15px; border-radius: 5px; background-color: #ffffff; color: black; }
        
        /* Harga dan Fasilitas */
        .harga { font-size: 18px; color: black; margin-top: 10px; font-weight: bold; } 
        .fasilitas { margin-top: 10px; font-size: 14px; color: black; background: #f4ebfa; padding: 10px; border-radius: 4px; }
    </style>
</head>
<body>

    <h1>Aplikasi Pemesanan Bioskop</h1>

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

    <hr style="border: 1px solid #ce93d8;">
    <h2>Daftar Tiket Terpesan</h2>
    <div class="container">

        <div class="kategori">
            <h2>Studio Regular</h2>
            <?php
            // Memfilter berdasarkan awalan [REG] di nama film
            $queryRegular = "SELECT * FROM tabel_tiket WHERE nama_film LIKE '[REG]%'"; 
            $resultRegular = $koneksi->query($queryRegular);

            if ($resultRegular->num_rows > 0) {
                while($row = $resultRegular->fetch_assoc()) {
                    $tiketReg = new TiketRegular($row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], $row['jumlah_kursi'], $row['harga_dasar_tiket'], "Dolby Digital", "Baris Tengah");
                    
                    echo "<div class='tiket-card'>";
                    echo "<strong>ID Tiket (Auto):</strong> " . $tiketReg->getIdTiket() . "<br>";
                    echo "<strong>Film:</strong> " . $tiketReg->getNamaFilm() . "<br>";
                    echo "<strong>Kursi:</strong> " . $tiketReg->getJumlahKursi() . "<br>";
                    echo "<div class='fasilitas'>"; $tiketReg->tampilkanInfoFasilitas(); echo "</div>";
                    echo "<div class='harga'>Total Harga: Rp " . number_format($tiketReg->hitungTotalHarga(), 0, ',', '.') . "</div>";
                    echo "</div>";
                }
            } else { echo "<p>Belum ada pemesanan di studio ini.</p>"; }
            ?>
        </div>

        <div class="kategori">
            <h2>Studio IMAX</h2>
            <?php
            // Memfilter berdasarkan awalan [IMX] di nama film
            $queryIMAX = "SELECT * FROM tabel_tiket WHERE nama_film LIKE '[IMX]%'"; 
            $resultIMAX = $koneksi->query($queryIMAX);

            if ($resultIMAX->num_rows > 0) {
                while($row = $resultIMAX->fetch_assoc()) {
                    $tiketIMX = new TiketIMAX($row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], $row['jumlah_kursi'], $row['harga_dasar_tiket'], "KCM-3D-VIP", "Active Motion Seat");
                    
                    echo "<div class='tiket-card'>";
                    echo "<strong>ID Tiket (Auto):</strong> " . $tiketIMX->getIdTiket() . "<br>";
                    echo "<strong>Film:</strong> " . $tiketIMX->getNamaFilm() . "<br>";
                    echo "<strong>Kursi:</strong> " . $tiketIMX->getJumlahKursi() . "<br>";
                    echo "<div class='fasilitas'>"; $tiketIMX->tampilkanInfoFasilitas(); echo "</div>";
                    echo "<div class='harga'>Total Harga: Rp " . number_format($tiketIMX->hitungTotalHarga(), 0, ',', '.') . "</div>";
                    echo "</div>";
                }
            } else { echo "<p>Belum ada pemesanan di studio ini.</p>"; }
            ?>
        </div>

        <div class="kategori">
            <h2>Studio Velvet</h2>
            <?php
            // Memfilter berdasarkan awalan [VLV] di nama film
            $queryVelvet = "SELECT * FROM tabel_tiket WHERE nama_film LIKE '[VLV]%'"; 
            $resultVelvet = $koneksi->query($queryVelvet);

            if ($resultVelvet->num_rows > 0) {
                while($row = $resultVelvet->fetch_assoc()) {
                    $tiketVlv = new TiketVelvet($row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], $row['jumlah_kursi'], $row['harga_dasar_tiket'], "Premium Bed Setup", "Tersedia");
                    
                    echo "<div class='tiket-card'>";
                    echo "<strong>ID Tiket (Auto):</strong> " . $tiketVlv->getIdTiket() . "<br>";
                    echo "<strong>Film:</strong> " . $tiketVlv->getNamaFilm() . "<br>";
                    echo "<strong>Kursi:</strong> " . $tiketVlv->getJumlahKursi() . "<br>";
                    echo "<div class='fasilitas'>"; $tiketVlv->tampilkanInfoFasilitas(); echo "</div>";
                    echo "<div class='harga'>Total Harga: Rp " . number_format($tiketVlv->hitungTotalHarga(), 0, ',', '.') . "</div>";
                    echo "</div>";
                }
            } else { echo "<p>Belum ada pemesanan di studio ini.</p>"; }
            ?>
        </div>

    </div>

</body>
</html>

<?php
// Menutup koneksi
$koneksi->close();
?>