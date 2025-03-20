<?php
include '../koneksi.php';

$id_khasiatjamu = $_GET['id_khasiatjamu'];

$hapus = mysqli_query($mysqli, "DELETE FROM khasiat_jamu WHERE id_khasiatjamu= '$id_khasiatjamu'");

if ($hapus) {
	echo "<script> alert ('Data berhasil dihapus');
	document.location='kelola_khasiatjamu.php';
	</script>";
} else {
	echo "<script> alert ('Data Gagal dihapus') ;
	document.location='kelola_khasiatjamu.php';
	</script>";
}
