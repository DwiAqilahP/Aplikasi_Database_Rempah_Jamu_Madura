<?php
require_once "koneksi.php";

// Fungsi untuk mengambil data kota dari database
function getKotaOptions() {
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

    // Mengecek apakah alamat email sudah digunakan sebelumnya
    $email_check_query = "SELECT * FROM user WHERE email='$email' LIMIT 1";
    $result = mysqli_query($mysqli, $email_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // Jika email sudah digunakan
        echo '<script>alert("Alamat email sudah digunakan. Silakan gunakan alamat email yang berbeda.")</script>';
    } elseif ($password == $repassword) {     
        // Query SQL untuk menyimpan data registrasi ke database
        $sql = "INSERT INTO user (username, id_kota, email, pw) VALUES ('$username', '$id_kota', '$email', '$password')";
        if ($mysqli->query($sql) === TRUE) {
            // Pesan berhasil
            echo '<script>alert("Registrasi berhasil. Anda dapat masuk sekarang.")</script>';
            header("Location: login.php");
        } else {
            // Tangani kesalahan jika terjadi
            echo "Registrasi gagal: " . $mysqli->error;
        }
    } else {
        echo '<script>alert("Password tidak sama!")</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="register-container">
        <h1>Registrasi</h1>
        <form action="#" method="POST">
            <div class="input-field">
                <label for="register-username">Username</label>
                <input type="text" id="register-username" name="register-username" required>
            </div>
            <div class="input-field">
                <label for="kota">Kota</label>
                <select id="kota" name="kota" required>
                    <?php echo getKotaOptions(); ?>
                </select>
            </div>
            <div class="input-field">
                <label for="register-email">Email</label>
                <input type="email" id="register-email" name="register-email" required>
            </div>
            <div class="input-field">
                <label for="register-password">Password</label>
                <input type="password" id="register-password" name="register-password" required>
            </div>
            <div class="input-field">
                <label for="repassword">Konfirmasi Password</label>
                <input type="password" id="repassword" name="repassword" required>
            </div>
            <button type="submit" name="submit">Daftar</button>
        </form>
        <br>
        <p>Sudah punya akun? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
