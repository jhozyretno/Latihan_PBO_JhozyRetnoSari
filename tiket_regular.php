<?php
require_once 'tiket.php';

class TiketRegular extends Tiket {
    // Properti tambahan khusus
    protected $tipeAudio;
    protected $lokasiBaris;

    // Constructor gabungan
    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket, $tipeAudio, $lokasiBaris) {
        // Memanggil constructor dari class induk (Tiket)
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket);
        
        // Mengisi properti khusus class ini
        $this->tipeAudio = $tipeAudio;
        $this->lokasiBaris = $lokasiBaris;
    }

    // Implementasi wajib dari metode abstrak
    public function hitungTotalHarga() {
        // Tarif standar murni tanpa biaya tambahan fasilitas
        return $this->jumlah_kursi * $this->harga_dasar_tiket; 
    }

    public function tampilkanInfoFasilitas() {
        echo "Fasilitas Studio Regular:<br>";
        echo "- Tipe Audio: " . $this->tipeAudio . "<br>";
        echo "- Lokasi Baris: " . $this->lokasiBaris . "<br>";
    }

    // (Opsional) Getter untuk properti khusus
    public function getTipeAudio() { return $this->tipeAudio; }
    public function getLokasiBaris() { return $this->lokasiBaris; }
}
?>