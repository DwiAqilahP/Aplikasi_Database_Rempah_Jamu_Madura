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
    <title>Edit Jamu</title>
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
$id_khasiatjamu = $_GET['id_khasiatjamu'];
if (isset($_POST['submit'])) {
    $nama_jamu = $_POST['nama_jamu'];
    $ket_jamu = $_POST['ket_jamu'];
    $sql = mysqli_query($mysqli, "UPDATE jamu SET nama_jamu = '$nama_jamu',ket_jamu ='$ket_jamu' WHERE id_khasiatjamu= '$id_khasiatjamu' ");
    if ($sql) {
        // Pesan berhasil
        echo '<script>
        alert("Data jamu berhasil diedit")
        </script>';
        header("Location: kelola_jamu.php");
    } else {
        // Tangani kesalahan jika terjadi
        echo "Edit gagal: " . $mysqli->error;
    }
} ?>

<body>
    <div class="container">
        <h1>Edit jamu</h1>
        <form method="POST" action="">
            <?php 
            $id_user = $_SESSION['id_user'];

            // Query untuk mengambil data nama jamu dari tabel jamu
            $queryNamaJamu = "SELECT id_jamu, nama_jamu FROM jamu WHERE id_user = '$id_user'";
            $resultNamaJamu = $mysqli->query($queryNamaJamu);

            $queryKhasiat = "SELECT id_khasiat, khasiat FROM khasiat";
            $resultKhasiat = $mysqli->query($queryKhasiat);

             ?>

                <label for="nama_jamu">Nama jamu</label>
                <select id="nama_jamu" name="nama_jamu" required>
                    <?php
                    while ($rowNamaJamu = $resultNamaJamu->fetch_assoc()) {
                        $selected = ($rowNamaJamu['id_jamu'] == $rowEditKhasiatJamu['id_jamu']) ? 'selected' : '';
                        echo "<option value='" . $rowNamaJamu['id_jamu'] . "' $selected>" . $rowNamaJamu['nama_jamu'] . "</option>";
                    }
                    ?>
                </select>

              <label for="khasiat">Khasiat</label>
                <select id="khasiat" name="khasiat" required>
                    <?php
                    while ($rowkhasiat = $resultkhasiat->fetch_assoc()) {
                        $selected = ($rowkhasiat['id_khasiat'] == $rowEditKhasiatJamu['id_khasiat']) ? 'selected' : '';
                        echo "<option value='" . $rowkhasiat['id_khasiat'] . "' $selected>" . $rowkhasiat['khasiat'] . "</option>";
                    }
                    ?>
                </select>
            <button type="submit" name="submit">Simpan</button>
        </form>
    </div>
</body>

</html>