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
    <title>Edit Khasiat</title>
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
$id_khasiat = $_GET['id_khasiat'];
if (isset($_POST['submit'])) {
    $khasiat = $_POST['khasiat'];
    $ket_khasiat = $_POST['ket_khasiat'];
    $sql = mysqli_query($mysqli, "UPDATE khasiat SET khasiat = '$khasiat',ket_khasiat ='$ket_khasiat' WHERE id_khasiat= '$id_khasiat' ");
    if ($sql) {
        // Pesan berhasil
        echo '<script>
        alert("Data khasiat berhasil diedit")
        </script>';
        header("Location: kelola_khasiat.php");
    } else {
        // Tangani kesalahan jika terjadi
        echo "Edit gagal: " . $mysqli->error;
    }
} ?>

<body>
    <div class="container">
        <h1>Edit khasiat</h1>
        <form method="POST" action="">
            <?php
            $data = mysqli_query($mysqli, "SELECT * FROM khasiat WHERE id_khasiat = '$id_khasiat'");
            while ($tampil = mysqli_fetch_array($data)) {
            ?>
                <label for="khasiat">Nama khasiat</label>
                <input type="text" id="khasiat" name="khasiat" value="<?= $tampil['khasiat']; ?>" required>

                <label for="ket_khasiat">Keterangan</label>
                <textarea id="ket_khasiat" name="ket_khasiat" rows="3"><?= $tampil['ket_khasiat']; ?></textarea>
            <?php } ?>
            <button type="submit" name="submit">Simpan</button>
        </form>
    </div>
</body>

</html>