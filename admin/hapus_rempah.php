<?php
include '../koneksi.php';

$id_rempah = $_GET['id_rempah'];

$hapus = mysqli_query($mysqli, "DELETE FROM rempah WHERE id_rempah= '$id_rempah'");

if ($hapus) {
    echo "<script> alert ('Data berhasil dihapus');
	document.location='kelola_rempah.php';
	</script>";
} else {
    echo "<script> alert ('Data Gagal dihapus') ;
	document.location='kelola_rempah.php';
	</script>";
}
