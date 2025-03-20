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
        textarea,
        select {
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
$id_jamu = $_GET['id_jamu'];
if (isset($_POST['submit'])) {
    $nama_jamu = $_POST['nama_jamu'];
    $ket_jamu = $_POST['ket_jamu'];
    $id_user = $_POST['id_user'];

    // Mengambil informasi file yang diunggah
    $file_name = $_FILES['gambar_jamu']['name'];
    $file_tmp = $_FILES['gambar_jamu']['tmp_name'];
    $file_size = $_FILES['gambar_jamu']['size'];
    $file_error = $_FILES['gambar_jamu']['error'];

    // Cek apakah file berhasil diunggah
    if ($file_error === 0) {
        // Pindahkan file ke direktori yang Anda inginkan
        $file_destination = "../gambar/" . $file_name;
        move_uploaded_file($file_tmp, $file_destination);

        // Update data ke dalam database termasuk gambar (jika diunggah)
        $sql = mysqli_query($mysqli, "UPDATE jamu SET nama_jamu = '$nama_jamu', ket_jamu = '$ket_jamu', gambar_jamu = '$file_name', id_user = '$id_user' WHERE id_jamu = '$id_jamu'");
    } else {
        // Update data ke dalam database tanpa mengubah gambar
        $sql = mysqli_query($mysqli, "UPDATE jamu SET nama_jamu = '$nama_jamu', ket_jamu = '$ket_jamu', id_user = '$id_user' WHERE id_jamu = '$id_jamu'");
    }

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
}
?>

<body>
    <div class="container">
        <h1>Edit jamu</h1>
        <form method="POST" action="" enctype="multipart/form-data">
            <?php
            $data = mysqli_query($mysqli, "SELECT * FROM jamu WHERE id_jamu = '$id_jamu'");
            while ($tampil = mysqli_fetch_array($data)) {
            ?>
                <label for="id_user">Pilih User:</label>
                <select id="id_user" name="id_user" required>
                    <?php
                    // Query untuk mengambil data user
                    $query_users = "SELECT * FROM user";
                    $result_users = mysqli_query($mysqli, $query_users);
                    while ($row_users = mysqli_fetch_assoc($result_users)) {
                        // Periksa apakah user ini adalah pemilik jamu yang sedang diedit
                        $selected = ($row_users['id_user'] == $tampil['id_user']) ? 'selected' : '';

                        echo '<option value="' . $row_users['id_user'] . '" ' . $selected . '>' . $row_users['username'] . '</option>';
                    }
                    ?>
                </select>

                <label for="nama_jamu">Nama jamu</label>
                <input type="text" id="nama_jamu" name="nama_jamu" value="<?= $tampil['nama_jamu']; ?>" required>

                <label for="ket_jamu">Keterangan</label>
                <textarea id="ket_jamu" name="ket_jamu" rows="3"><?= $tampil['ket_jamu']; ?></textarea>

                <label for="gambar_jamu">Gambar Jamu (Biarkan kosong jika tidak ingin mengubah)</label>
                <input type="file" id="gambar_jamu" name="gambar_jamu" accept="image/*">

                <img src="../gambar/<?= $tampil['gambar_jamu']; ?>" alt="<?= $tampil['nama_jamu']; ?>" style="max-width: 200px; height: auto;">
            <?php } ?>
            <button type="submit" name="submit">Simpan</button>
        </form>

    </div>
</body>

</html>
