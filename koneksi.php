<?php
// Konfigurasi database
$host = "localhost"; // Ganti dengan nama host Anda
$username = "root"; // Ganti dengan nama pengguna database Anda
$password = ""; // Ganti dengan kata sandi database Anda
$database = "db_rempahjamu"; // Ganti dengan nama database Anda

// Membuat koneksi ke database menggunakan mysqli
$mysqli = new mysqli($host, $username, $password, $database);

// Memeriksa koneksi
if ($mysqli->connect_error) {
    die("Koneksi ke database gagal: " . $mysqli->connect_error);
}
