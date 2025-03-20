<?php
include '../koneksi.php';

$id_jamu = $_GET['id_jamu'];

$hapus = mysqli_query($mysqli, "DELETE FROM jamu WHERE id_jamu= '$id_jamu'");

if ($hapus) {
    echo "<script> alert ('Data berhasil dihapus');
	document.location='kelola_jamu.php';
	</script>";
} else {
    echo "<script> alert ('Data Gagal dihapus') ;
	document.location='kelola_jamu.php';
	</script>";
}
