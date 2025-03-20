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
    <title>Tambah Kota</title>
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
    $nama_kota = $_POST['nama_kota'];
    $ket_kota = $_POST['ket_kota'];
    $sql = "INSERT INTO kota (nama_kota, ket_kota) VALUES ('$nama_kota', '$ket_kota')";
    if ($mysqli->query($sql) === TRUE) {
        // Pesan berhasil
        echo '<script>
        alert("kota berhasil ditambahkan")
        </script>';
        header("Location: kelola_kota.php");
    } else {
        // Tangani kesalahan jika terjadi
        echo "Penambahan gagal: " . $mysqli->error;
    }
} ?>

<body>
    <div class="container">
        <h1>Tambah kota</h1>
        <form method="POST" action="">
            <label for="nama_kota">Nama kota</label>
            <input type="text" id="nama_kota" name="nama_kota" required>

            <label for="ket_kota">Keterangan</label>
            <textarea id="ket_kota" name="ket_kota" rows="3"></textarea>

            <button type="submit" name="submit">Simpan</button>
        </form>
    </div>
</body>

</html>