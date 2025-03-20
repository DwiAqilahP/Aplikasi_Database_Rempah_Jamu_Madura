<?php
include '../koneksi.php';

$id_khasiat = $_GET['id_khasiat'];

$hapus = mysqli_query($mysqli, "DELETE FROM khasiat WHERE id_khasiat= '$id_khasiat'");

if ($hapus) {
    echo "<script> alert ('Data berhasil dihapus');
	document.location='kelola_khasiat.php';
	</script>";
} else {
    echo "<script> alert ('Data Gagal dihapus') ;
	document.location='kelola_khasiat.php';
	</script>";
}
