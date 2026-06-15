<?php
// Sesuaikan dengan konfigurasi database MySQL kamu
$host = "localhost";
$username = "root";
$password = ""; // Kosongkan jika menggunakan XAMPP bawaan
$database = "nama_database_kamu"; // Ganti dengan nama database latihanmu

$koneksi = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>