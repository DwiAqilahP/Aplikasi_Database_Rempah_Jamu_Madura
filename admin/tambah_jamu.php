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
    <title>Tambah Jamu</title>
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
    $id_user = $_POST['id_user'];
    $nama_jamu = $_POST['nama_jamu'];
    $ket_jamu = $_POST['ket_jamu'];

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

        // Masukkan data ke dalam database
        $sql = "INSERT INTO jamu (nama_jamu, ket_jamu, gambar_jamu, id_user) VALUES ('$nama_jamu', '$ket_jamu', '$file_name', '$id_user')";
        
        if ($mysqli->query($sql) === TRUE) {
            // Pesan berhasil
            echo '<script>
            alert("jamu berhasil ditambahkan")
            </script>';
            header("Location: kelola_jamu.php");
        } else {
            // Tangani kesalahan jika terjadi
            echo "Penambahan gagal: " . $mysqli->error;
        }
    } else {
        // Tangani kesalahan jika file tidak berhasil diunggah
        echo "Error uploading file!";
    }
} ?>


<body>
    <div class="container">
        <h1>Tambah jamu</h1>
        <form method="POST" action="" enctype="multipart/form-data">

        <label for="id_user">Pilih User:</label>
        <select id="id_user" name="id_user" required>
            <?php
            $query_users = "SELECT * FROM user WHERE username != 'admin'";
            $result_users = mysqli_query($mysqli, $query_users);
            while ($row_users = mysqli_fetch_assoc($result_users)) {
                echo '<option value="' . $row_users['id_user'] . '">' . $row_users['username'] . '</option>';
            }
            ?>
        </select>


        <label for="nama_jamu">Nama jamu</label>
        <input type="text" id="nama_jamu" name="nama_jamu" required>

        <label for="ket_jamu">Keterangan</label>
        <textarea id="ket_jamu" name="ket_jamu" rows="3"></textarea>

        <label for="gambar_jamu">Gambar Jamu</label>
        <input type="file" id="gambar_jamu" name="gambar_jamu" accept="image/*" required>

        <button type="submit" name="submit">Simpan</button>
    </form>

    </div>
</body>

</html>