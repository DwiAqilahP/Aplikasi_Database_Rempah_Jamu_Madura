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
    <title>Tambah Khasiat Jamu</title>
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

        select,
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

<?php
include "../koneksi.php";
if (isset($_POST['submit'])) {
    $id_jamu = $_POST['nama_jamu'];
    $id_khasiat = $_POST['khasiat'];

    // Menggunakan prepared statement
    $sql = "INSERT INTO khasiat_jamu (id_jamu, id_khasiat) VALUES ('$id_jamu','$id_khasiat' )";
    if ($mysqli->query($sql) === TRUE) {
        // Pesan berhasil
        echo '<script>
        alert("khasiat jamu berhasil ditambahkan")
        </script>';
        header("Location: kelola_khasiatjamu.php");
    } else {
        // Tangani kesalahan jika terjadi
        echo "Penambahan gagal: " . $mysqli->error;
    }
}

$id_user = $_SESSION['id_user'];

// Query untuk mengambil data nama jamu dari tabel jamu
$queryNamaJamu = "SELECT id_jamu, nama_jamu FROM jamu WHERE id_user = '$id_user'";
$resultNamaJamu = $mysqli->query($queryNamaJamu);

// Query untuk mengambil data khasiat dari tabel khasiat
$queryKhasiat = "SELECT id_khasiat, khasiat FROM khasiat";
$resultKhasiat = $mysqli->query($queryKhasiat);
?>

<body>
    <div class="container">
        <h1>Tambah jamu</h1>
        <form method="POST" action="">
            <label for="nama_jamu">Nama jamu</label>
            <select id="nama_jamu" name="nama_jamu" required>
                <?php
                while ($rowNamaJamu = $resultNamaJamu->fetch_assoc()) {
                    echo "<option value='" . $rowNamaJamu['id_jamu'] . "'>" . $rowNamaJamu['nama_jamu'] . "</option>";
                }
                ?>
            </select>

            <label for="khasiat">Khasiat</label>
            <select id="khasiat" name="khasiat" required>
                <?php
                while ($rowKhasiat = $resultKhasiat->fetch_assoc()) {
                    echo "<option value='" . $rowKhasiat['id_khasiat'] . "'>" . $rowKhasiat['khasiat'] . "</option>";
                }
                ?>
            </select>

            <button type="submit" name="submit">Simpan</button>
        </form>
    </div>
</body>

</html>