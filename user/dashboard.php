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
    <title>Halaman Utama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/style_user.css">
</head>

<body>
    <!-- Gunakan komponen navbar Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-dark"
        style='background-color:#FFFBF5;color:#000000;position: fixed; top: 0; width: 100%;'>
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
                        <a class="nav-link" href="../logout.php" style="color: #000000;">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php
        include "../koneksi.php";
        $username = $_SESSION['username'];
        $id_user = $_SESSION['id_user'];
        ?>
    <div class="container welcome">
        <h2 style="font-size: 60px;color: #71523B;">Selamat Datang <?php echo $username; ?></h2>
        <p><i>Lihat dan kelola Rempah-rempah produksi jamu!</i></p>
    </div>

    <div class="action-buttons">
            <a href="tambah_jamu.php" class="add-button">Tambah jamu</a>
        </div>

    <?php 
   $sql = "SELECT jamu.gambar_jamu, jamu.id_jamu as id, jamu.nama_jamu, GROUP_CONCAT(khasiat.khasiat SEPARATOR ', ') as khasiat
        FROM jamu
        LEFT JOIN khasiat_jamu ON jamu.id_jamu = khasiat_jamu.id_jamu
        LEFT JOIN khasiat ON khasiat.id_khasiat = khasiat_jamu.id_khasiat
        WHERE jamu.id_user = '$id_user'
        GROUP BY jamu.nama_jamu";
    $result = mysqli_query($mysqli, $sql);?>
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
            <img src="../gambar/<?= $data['gambar_jamu']; ?>" alt="<?= $data['nama_jamu']; ?>" style="max-width: 100%; height: auto;">
            <h3 style="color: #C8A287;"><?= $data['nama_jamu']; ?></h3>
            <p>khasiat: <?= $data['khasiat']; ?></p>
            <div class="btn-group">
                <button class="btn btn-primary view-composition" data-toggle="modal" data-target="#myModal-<?= $data['id']; ?>" data-jamu-id="<?= $data['id_jamu']; ?>" data-komposisi="<?= implode(', ', $komposisi); ?>">Lihat Komposisi</button>
                <button class="btn btn-primary settings-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-cog"></i> <!-- Ikon roda gigi -->
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href='edit_komposisi.php?id_jamu=<?php echo $id_jamu; ?>'>Edit</a>
                    <a class="dropdown-item" href="hapus_komposisi.php?id_jamu=<?= $id_jamu; ?>">Hapus</a>
                </div>
                
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="myModal-<?= $data['id']; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Komposisi Jamu <?= $data['nama_jamu']; ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <h4>Komposisi Jamu <?= $data['nama_jamu']; ?></h4>
                        <ul>
                            <?php foreach ($komposisi as $item) : ?>
                                <li><?= $item; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    
    </div>
    <script>
        $(document).ready(function() {
            $('.view-composition').click(function() {
                var jamuId = $(this).data('jamu-id');

                // Lakukan AJAX request untuk mengambil data komposisi
                $.ajax({
                    url: 'get_composition.php', // Ganti dengan URL yang sesuai
                    type: 'POST',
                    data: { jamu_id: jamuId },
                    success: function(response) {
                        $('#composition-details').html(response);
                        $('#myModal-' + jamuId).modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>




    <!-- Sertakan file JavaScript Bootstrap (jika diperlukan) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
