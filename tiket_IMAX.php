<?php
require_once 'tiket.php';

class TiketIMAX extends Tiket {
    // Properti tambahan khusus
    protected $kacamata3dId;
    protected $efekGerakFitur;

    // Constructor gabungan
    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket, $kacamata3dId, $efekGerakFitur) {
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket);
        $this->kacamata3dId = $kacamata3dId;
        $this->efekGerakFitur = $efekGerakFitur;
    }

    // Implementasi wajib dari metode abstrak
    public function hitungTotalHarga() {
        // Contoh: Harga dasar ditambah biaya fasilitas IMAX
        return $this->harga_dasar_tiket + 50000; 
    }

    public function tampilkanInfoFasilitas() {
        echo "Fasilitas Studio IMAX:<br>";
        echo "- ID Kacamata 3D: " . $this->kacamata3dId . "<br>";
        echo "- Efek Gerak: " . $this->efekGerakFitur . "<br>";
    }

    // (Opsional) Getter untuk properti khusus
    public function getKacamata3dId() { return $this->kacamata3dId; }
    public function getEfekGerakFitur() { return $this->efekGerakFitur; }
}
?>