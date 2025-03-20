<?php
include '../koneksi.php';

$id_kota = $_GET['id_kota'];

$hapus = mysqli_query($mysqli, "DELETE FROM kota WHERE id_kota= '$id_kota'");

if ($hapus) {
    echo "<script> alert ('Data berhasil dihapus');
	document.location='kelola_kota.php';
	</script>";
} else {
    echo "<script> alert ('Data Gagal dihapus') ;
	document.location='kelola_kota.php';
	</script>";
}
