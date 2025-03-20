<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style_user.css">
    <style>
        .navbar {
            position: relative;
            min-height: 50px;
            margin-bottom: 0px;
            border: 1px solid transparent;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Jamu Madura</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <!-- Tambahkan item navbar sesuai kebutuhan Anda -->
                    <li class="nav-item">
                        <a class="nav-link" href="lihat_jamu.php">Lihat Jamu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php include "koneksi.php"; ?>

    <div class="container welcome">
        <h2 style="font-size: 60px;color: #71523B;">JAMU TRADISIONAL MADURA</h2>
        <p><i>Lihat Jamu Madura</i></p>
        <form method="GET" action="">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari berdasarkan nama jamu/username/khasiat/kotaproduksi" name="q">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </div>
        </form>
    </div>

    <?php
    // Inisialisasi variabel pencarian
    $search_query = "";

    // Periksa apakah ada parameter pencarian
    if (isset($_GET['q'])) {
        $search_query = mysqli_real_escape_string($mysqli, $_GET['q']);
    }

    // Query SQL dengan filter pencarian
    $sql = "SELECT nama_kota, username, jamu.gambar_jamu, jamu.id_jamu as id, jamu.nama_jamu, GROUP_CONCAT(khasiat.khasiat SEPARATOR ', ') as khasiat
            FROM jamu
            LEFT JOIN khasiat_jamu ON jamu.id_jamu = khasiat_jamu.id_jamu
            LEFT JOIN khasiat ON khasiat.id_khasiat = khasiat_jamu.id_khasiat
            LEFT JOIN user ON jamu.id_user = user.id_user
            LEFT JOIN kota ON kota.id_kota = user.id_kota
            WHERE jamu.nama_jamu LIKE '%$search_query%' OR kota.nama_kota LIKE '%$search_query%' OR user.username LIKE '%$search_query%' OR khasiat.khasiat LIKE '%$search_query%'
            GROUP BY jamu.id_jamu";
    $result = mysqli_query($mysqli, $sql);
    ?>

    <div class="container menu-container">
        <?php
        while ($data = mysqli_fetch_assoc($result)) {
            $id_jamu = $data['id'];
            $sql_komposisi = "SELECT * FROM komposisi WHERE id_jamu = '$id_jamu'";
            $result_komposisi = mysqli_query($mysqli, $sql_komposisi);
            $komposisi = array();

            while ($row_komposisi = mysqli_fetch_assoc($result_komposisi)) {
                $id_rempah = $row_komposisi['id_rempah'];
                $banyak_rempah = $row_komposisi['banyak_rempah'];

                // Query untuk mengambil nama_rempah
                $sql_rempah = "SELECT nama_rempah FROM rempah WHERE id_rempah = '$id_rempah'";
                $result_rempah = mysqli_query($mysqli, $sql_rempah);
                $row_rempah = mysqli_fetch_assoc($result_rempah);

                $komposisi[] = $row_rempah['nama_rempah'];
            }
        ?>
        <div class="menu-box" style="background-color:#FFFBF5">
            <img src="gambar/<?= $data['gambar_jamu']; ?>" alt="<?= $data['nama_jamu']; ?>" style="max-width: 100%; height: auto;">
            <h3 style="color: #C8A287;"><?= $data['nama_jamu']; ?></h3>
            <p>Diproduksi oleh: <?= $data['username']; ?></p>
            <p>Di Kota: <?= $data['nama_kota']; ?></p>
            <p>Khasiat: <?= $data['khasiat']; ?></p>
            <div class="btn-group">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal-<?= $data['id']; ?>">Lihat Komposisi</button>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal-<?= $data['id']; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Komposisi Jamu <?= $data['nama_jamu']; ?></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <ul>
                            <?php foreach ($komposisi as $item) : ?>
                            <li><?= $item; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
