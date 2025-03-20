<?php
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: ../login.php");
  exit(); // Hentikan eksekusi skrip jika tidak ada sesi username
}

if (isset($_GET['id_jamu'])) {
  include "../koneksi.php";
  
  // Ambil ID Jamu dari parameter URL
  $id_jamu = $_GET['id_jamu'];
  
  // Hapus data khasiat_jamu berdasarkan ID Jamu
  $queryDeleteKhasiatJamu = "DELETE FROM khasiat_jamu WHERE id_jamu = '$id_jamu'";
  $resultDeleteKhasiatJamu = mysqli_query($mysqli, $queryDeleteKhasiatJamu);

  // Hapus data komposisi berdasarkan ID Jamu
  $queryDeleteKomposisi = "DELETE FROM komposisi WHERE id_jamu = '$id_jamu'";
  $resultDeleteKomposisi = mysqli_query($mysqli, $queryDeleteKomposisi);
  
  // Hapus data jamu berdasarkan ID
  $queryDeleteJamu = "DELETE FROM jamu WHERE id_jamu = '$id_jamu'";
  $resultDeleteJamu = mysqli_query($mysqli, $queryDeleteJamu);

  if ($resultDeleteJamu && $resultDeleteKhasiatJamu && $resultDeleteKomposisi) {
    // Redirect kembali ke halaman sebelumnya
    header("Location: dashboard.php");
    exit();
  } else {
    echo "Gagal menghapus data jamu, khasiat_jamu, atau komposisi.";
  }
} else {
  echo "ID Jamu tidak valid.";
}
