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
    <link rel="stylesheet" href="../css/style_user.css">
</head>

<body>
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
                        <a class="nav-link" href="kelola_kota.php" style="color: #000000;">Kelola Kota</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kelola_user.php" style="color: #000000;">Kelola User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kelola_rempah.php" style="color: #000000;">Kelola Rempah</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kelola_jamu.php" style="color: #000000;">Kelola Jamu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kelola_khasiat.php" style="color: #000000;">Kelola khasiat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php" style="color: #000000;">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container1">
        <h1>Daftar user</h1>
        <div class="action-buttons">
            <a href="tambah_user.php" class="add-button">Tambah user</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Kota</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php include "../koneksi.php"; ?>
                <?php
                $results_per_page = 10; // Jumlah hasil per halaman
                $sql = "SELECT * FROM user left join kota on kota.id_kota=user.id_kota WHERE id_user != 1";
                $result = mysqli_query($mysqli, $sql);
                $number_of_results = mysqli_num_rows($result);

                // Menentukan jumlah halaman
                $number_of_pages = ceil($number_of_results / $results_per_page);

                if (!isset($_GET['page'])) {
                    $page = 1; // Halaman default
                } else {
                    $page = $_GET['page'];
                }

                $this_page_first_result = ($page - 1) * $results_per_page;
                $sql = "SELECT * FROM user left join kota on kota.id_kota=user.id_kota WHERE id_user != 1 LIMIT " . $this_page_first_result . ',' . $results_per_page;
                $result = mysqli_query($mysqli, $sql);
                $no = $this_page_first_result + 1;

                while ($data = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['username']; ?></td>
                    <td><?php echo $data['email']; ?></td>
                    <td><?php echo $data['nama_kota'] ?></td>
                    <td>
                        <a href='hapus_user.php?id_user=<?php echo $data['id_user']; ?>'>
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>&nbsp; &nbsp; &nbsp;
                        <a href='edit_user.php?id_user=<?php echo $data['id_user']; ?>'>
                            <span class="glyphicon glyphicon-edit"></span>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <!-- Pagination -->
        <ul class="pagination">
            <?php
            for ($page = 1; $page <= $number_of_pages; $page++) {
                echo '<li class="page-item"><a class="page-link" href="kelola_user.php?page=' . $page . '">' . $page . '</a></li>';
            }
            ?>
        </ul>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- ... (kode lainnya) -->
</body>

</html>