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
        input[type="email"],
        input[type="password"],
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

// Fungsi untuk mengambil data kota dari database
function getKotaOptions()
{
    global $mysqli;
    $options = "";
    $query = "SELECT nama_kota FROM kota";
    $result = $mysqli->query($query);
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $options .= "<option value='" . $row['nama_kota'] . "'>" . $row['nama_kota'] . "</option>";
        }
        $result->free();
    }
    return $options;
}
if (isset($_POST['submit'])) {
    // Mendapatkan data dari formulir registrasi
    $username = $_POST['register-username'];
    $kota = $_POST['kota'];
    $email = $_POST['register-email'];
    $password = $_POST['register-password'];
    $repassword = $_POST['repassword'];
    $result_id_kota = mysqli_query($mysqli, "SELECT id_kota FROM kota WHERE nama_kota = '$kota'");
    if ($row_id_kota = mysqli_fetch_assoc($result_id_kota)) {
        $id_kota = $row_id_kota['id_kota'];
    }

    if ($password == $repassword) {
        // Query SQL untuk menyimpan data registrasi ke database
        $sql = "INSERT INTO user (username, id_kota, email, pw) VALUES ('$username', '$id_kota', '$email', '$password')";
        if ($mysqli->query($sql) === TRUE) {
            // Pesan berhasil
            echo '<script>alert("Registrasi berhasil. Anda dapat masuk sekarang.")</script>';
            header("Location: kelola_user.php");
        } else {
            // Tangani kesalahan jika terjadi
            echo "Registrasi gagal: " . $mysqli->error;
        }
    } else {
        echo '<script>alert("Password tidak sama!")</script>';
    }
} ?>

<body>
    <div class="container">
        <h1>Tambah kota</h1>
        <form method="POST" action="">
            <label for="register-username">Username</label>
            <input type="text" id="register-username" name="register-username" required>
            <label for="kota">Kota</label>
            <select id="kota" name="kota" required>
                <?php echo getKotaOptions(); ?>
            </select>
            <label for="register-email">Email</label>
            <input type="email" id="register-email" name="register-email" required>
            <label for="register-password">Password</label>
            <input type="password" id="register-password" name="register-password" required>
            <label for="repassword">Konfirmasi Password</label>
            <input type="password" id="repassword" name="repassword" required><br>
            <button type="submit" name="submit">Simpan</button>
        </form>
    </div>
</body>

</html>