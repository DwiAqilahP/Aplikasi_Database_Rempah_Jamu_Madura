<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
}

require_once "../koneksi.php";

if (isset($_POST['submit'])) {
     $nama_jamu = $_POST["nama_jamu"];
    $daftar_rempah = $_POST["daftar_rempah"];

    // ID User (misalnya, Anda bisa mengambilnya dari $_SESSION)
    $id_user = $_SESSION['id_user'];

    // Ambil data Khasiat dari form
    $id_khasiat = $_POST["daftar_khasiat"];

    // Cek apakah jamu sudah ada dalam tabel data jamu
    $cek_query = "SELECT id_jamu FROM jamu WHERE nama_jamu = '$nama_jamu'";
    $cek_result = mysqli_query($mysqli, $cek_query);

    if (mysqli_num_rows($cek_result) == 0) {
        // Jika jamu belum ada, tambahkan ke tabel jamu
        $insert_jamu_query = "INSERT INTO jamu (nama_jamu) VALUES ('$nama_jamu')";
        $insert_jamu_result = mysqli_query($mysqli, $insert_jamu_query);

        if (!$insert_jamu_result) {
            echo "Gagal menyimpan jamu: " . mysqli_error($mysqli);
        }
    }

    // Simpan data komposisi ke dalam tabel komposisi
    $id_jamu = mysqli_insert_id($mysqli); // Ambil ID jamu (baru atau yang sudah ada)
    $komposisi_query = "INSERT INTO komposisi (id_jamu) VALUES ('$id_jamu')";
    $komposisi_result = mysqli_query($mysqli, $komposisi_query);

    if ($komposisi_result) {
        echo "Komposisi berhasil disimpan!";
    } else {
        echo "Gagal menyimpan komposisi: " . mysqli_error($mysqli);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/style_user.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style='background-color:#FFFBF5;color:#000000; top: 0; width: 100%;'>
        <div class="container">
            <a class="navbar-brand" href="dashboard.php" style="color: #000000;">DBRempahJamu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="kelola_jamu.php" style="color: #000000;">Kelola Jamu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kelola_khasiatjamu.php" style="color: #000000;">Kelola Khasiat
                            Jamu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kelola_komposisi.php" style="color: #000000;">Kelola Komposisi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php" style="color: #000000;">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <form method="post" action="">
        <label for="nama_jamu">Jamu:</label>
        <input type="text" name="nama_jamu" id="nama_jamu" required>
        <br>
        <label for="khasiat">Khasiat:</label>
        <input type="text" name="khasiat" id="khasiat">
        <input type="button" value="Tambah Khasiat" onclick="tambahKhasiat()">
        <div>
            <h3>Khasiat yang Ditambahkan:</h3>
            <ul id="daftar_khasiat">
                <!-- Daftar khasiat yang ditambahkan akan muncul di sini -->
            </ul>
        </div>
        <br>
        <label for="rempah">Rempah:</label>
        <select name="rempah" id="rempah">
            <?php
            $query = "SELECT * FROM rempah";
            $result = mysqli_query($mysqli, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['id_rempah'] . "'>" . $row['nama_rempah'] . "</option>";
            }
            ?>
        </select>
        <input type="button" value="Tambah Rempah" onclick="tambahRempah()">
        <div>
            <h3>Rempah yang Ditambahkan:</h3>
            <ul id="daftar_rempah">
                <!-- Daftar rempah yang ditambahkan akan muncul di sini -->
            </ul>
        </div>
        <input type="submit" name="submit" value="Simpan">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
    let daftarKhasiat = [];
    let daftarRempah = [];


    function tambahKhasiat() {
        const khasiatInput = document.getElementById("khasiat").value;
        if (khasiatInput !== "" && !daftarKhasiat.includes(khasiatInput)) {
            daftarKhasiat.push(khasiatInput);
            updateDaftarKhasiat();
        }
    }
     function tambahRempah() {
        const rempahSelect = document.getElementById("rempah");
        const rempahValue = rempahSelect.options[rempahSelect.selectedIndex].text;
        if (rempahValue !== "" && !daftarRempah.includes(rempahValue)) {
            daftarRempah.push(rempahValue);
            updateDaftarRempah();
        }
    }

    function hapusKhasiat(index) {
        daftarKhasiat.splice(index, 1);
        updateDaftarKhasiat();
    }
    function hapusRempah(index) {
        daftarRempah.splice(index, 1);
        updateDaftarRempah();
    }

    function updateDaftarKhasiat() {
        const daftarKhasiatElem = document.getElementById("daftar_khasiat");
        daftarKhasiatElem.innerHTML = "";
        daftarKhasiat.forEach((khasiat, index) => {
            const li = document.createElement("li");
            li.textContent = khasiat;
            const deleteButton = document.createElement("button");
            deleteButton.textContent = "Hapus";
            deleteButton.onclick = () => hapusKhasiat(index);
            li.appendChild(deleteButton);
            daftarKhasiatElem.appendChild(li);
        });
    }

     function updateDaftarRempah() {
        const daftarRempahElem = document.getElementById("daftar_rempah");
        daftarRempahElem.innerHTML = "";
        daftarRempah.forEach((rempah, index) => {
            const li = document.createElement("li");
            li.textContent = rempah;
            const deleteButton = document.createElement("button");
            deleteButton.textContent = "Hapus";
            deleteButton.onclick = () => hapusRempah(index);
            li.appendChild(deleteButton);
            daftarRempahElem.appendChild(li);
        });
    }
    </script>
</body>

</html>
