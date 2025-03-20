<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kota</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }

    .container {
        max-width: 500px;
        margin: 0 auto;
        padding: 50px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        background-color: #333;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #555;
    }
    </style>
</head>
<?php include "../koneksi.php";
$id_kota = $_GET['id_kota'];
if (isset($_POST['submit'])) {
    $nama_kota = $_POST['nama_kota'];
    $ket_kota = $_POST['ket_kota'];
    $sql = mysqli_query($mysqli, "UPDATE kota SET nama_kota = '$nama_kota',ket_kota ='$ket_kota' WHERE id_kota= '$id_kota' ");
    if ($sql) {
        // Pesan berhasil
        echo '<script>
        alert("Data kota berhasil diedit")
        </script>';
        header("Location: kelola_kota.php");
    } else {
        // Tangani kesalahan jika terjadi
        echo "Edit gagal: " . $mysqli->error;
    }
} ?>

<body>
    <div class="container">
        <h1>Edit kota</h1>
        <form method="POST" action="">
            <?php
            $data = mysqli_query($mysqli, "SELECT * FROM kota WHERE id_kota = '$id_kota'");
            while ($tampil = mysqli_fetch_array($data)) {
            ?>
            <label for="nama_kota">Nama kota</label>
            <input type="text" id="nama_kota" name="nama_kota" value="<?= $tampil['nama_kota']; ?>" required>

            <label for="ket_kota">Keterangan</label>
            <textarea id="ket_kota" name="ket_kota" rows="3"><?= $tampil['ket_kota']; ?></textarea>
            <?php } ?>
            <button type="submit" name="submit">Simpan</button>
        </form>
    </div>
</body>

</html>