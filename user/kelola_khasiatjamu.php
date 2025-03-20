<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Khasiat Jamu</title>
    <style>
        /* CSS styling di sini */
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        form {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        select,
        input[type="checkbox"] {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Pilih Jamu dan Khasiat</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="jamu">Pilih Jamu:</label>
        <select name="jamu" id="jamu">
            <?php
             include "../koneksi.php";

            // Query untuk mengambil data jamu
            $id_user = $_SESSION['id_user'];
            $query = "SELECT * FROM jamu WHERE id_user = '$id_user'";
            $result = mysqli_query($mysqli, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['id_jamu'] . "'>" . $row['nama_jamu'] . "</option>";
            }
            ?>
        </select>

        <label>Pilih Khasiat:</label>
        <?php
        // Query untuk mengambil data khasiat
        $query = "SELECT * FROM khasiat";
        $result = mysqli_query($mysqli, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<input type='checkbox' name='khasiat[]' value='" . $row['id_khasiat'] . "'>" . $row['khasiat'] . "<br>";
        }
        ?>

        <label for="rempah">Pilih Rempah:</label>
        <?php
        // Query untuk mengambil data rempah
        $query_rempah = "SELECT * FROM rempah";
        $result_rempah = mysqli_query($mysqli, $query_rempah);

        while ($row_rempah = mysqli_fetch_assoc($result_rempah)) {
            echo "<input type='checkbox' name='rempah[]' value='" . $row_rempah['id_rempah'] . "'>" . $row_rempah['nama_rempah'] . "<br>";
        }
        ?>

        <input type="submit" name="submit" value="Simpan">
    </form>

    <?php
    // Proses input saat formulir dikirim
    if (isset($_POST['submit'])) {
        // Ambil data yang dikirim dari formulir
        $id_jamu = $_POST['jamu'];
        $khasiat = $_POST['khasiat'];
        $id_rempah = $_POST['rempah'];


        // Loop melalui khasiat yang dipilih dan masukkan ke dalam tabel hubungan
        foreach ($khasiat as $id_khasiat) {
            $query = "INSERT INTO khasiat_jamu (id_jamu, id_khasiat) VALUES ('$id_jamu', '$id_khasiat')";
            mysqli_query($mysqli, $query);
        }
        // Loop melalui rempah yang dipilih
        foreach ($id_rempah as $key => $id_single_rempah) {

            $query_komposisi = "INSERT INTO komposisi (id_jamu, id_rempah) VALUES ('$id_jamu', '$id_single_rempah')";
            mysqli_query($mysqli, $query_komposisi);
        }



        // Redirect kembali ke halaman utama
        header("Location: " . $_SERVER['PHP_SELF']);
    }
    ?>
</body>
</html>
