<?php
require_once 'tiket.php';

class TiketVelvet extends Tiket {
    // Properti tambahan khusus
    protected $bantalSelimutPack;
    protected $layananButler;

    // Constructor gabungan
    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket, $bantalSelimutPack, $layananButler) {
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket);
        $this->bantalSelimutPack = $bantalSelimutPack;
        $this->layananButler = $layananButler;
    }

    // Implementasi wajib dari metode abstrak
    public function hitungTotalHarga() {
        // Dikenakan surcharge/biaya tambahan 50% (dikali 1.50)
        return ($this->jumlah_kursi * $this->harga_dasar_tiket) * 1.50; 
    }

    public function tampilkanInfoFasilitas() {
        echo "Fasilitas Studio Velvet:<br>";
        echo "- Bantal & Selimut: " . $this->bantalSelimutPack . "<br>";
        echo "- Layanan Butler: " . $this->layananButler . "<br>";
    }

    // (Opsional) Getter untuk properti khusus
    public function getBantalSelimutPack() { return $this->bantalSelimutPack; }
    public function getLayananButler() { return $this->layananButler; }
}
?>