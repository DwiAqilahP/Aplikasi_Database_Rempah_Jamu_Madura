<?php
include '../koneksi.php';

$id_user = $_GET['id_user'];

$hapus = mysqli_query($mysqli, "DELETE FROM user WHERE id_user= '$id_user'");

if ($hapus) {
    echo "<script> alert ('Data berhasil dihapus');
	document.location='kelola_user.php';
	</script>";
} else {
    echo "<script> alert ('Data Gagal dihapus') ;
	document.location='kelola_user.php';
	</script>";
}
