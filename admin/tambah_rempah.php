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
    <title>Tambah Rempah</title>
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
if (isset($_POST['submit'])) {
    $nama_rempah = $_POST['nama_rempah'];
    $ket_rempah = $_POST['ket_rempah'];
    $sql = "INSERT INTO rempah (nama_rempah, ket_rempah) VALUES ('$nama_rempah', '$ket_rempah')";
    if ($mysqli->query($sql) === TRUE) {
        // Pesan berhasil
        echo '<script>
        alert("Rempah berhasil ditambahkan")
        </script>';
        header("Location: kelola_rempah.php");
    } else {
        // Tangani kesalahan jika terjadi
        echo "Penambahan gagal: " . $mysqli->error;
    }
} ?>

<body>
    <div class="container">
        <h1>Tambah Rempah</h1>
        <form method="POST" action="">
            <label for="nama_rempah">Nama Rempah</label>
            <input type="text" id="nama_rempah" name="nama_rempah" required>

            <label for="ket_rempah">Keterangan</label>
            <textarea id="ket_rempah" name="ket_rempah" rows="3"></textarea>

            <button type="submit" name="submit">Simpan</button>
        </form>
    </div>
</body>

</html>