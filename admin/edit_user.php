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
    <title>Edit User/Update</title>
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
$id_user = $_GET['id_user'];

?>

<body>
    <div class="container">
        <h1>Edit User/Update</h1>
        <form method="POST" action="">
            <?php
            $data = mysqli_query($mysqli, "SELECT * FROM user WHERE id_user = '$id_user'");
            while ($tampil = mysqli_fetch_array($data)) {
            ?>
            <label for="edited-username">Username</label>
            <input type="text" id="edited-username" name="username" value="<?php echo $tampil['username']; ?>" required>
            <label for="edited-kota">Kota</label>
            <select id="edited-kota" name="kota" required>
                <?php
                    // Query untuk mengambil data user
                    $query_kota = "SELECT * FROM kota";
                    $result_kota = mysqli_query($mysqli, $query_kota);
                    while ($row_kota = mysqli_fetch_assoc($result_kota)) {
                        // Periksa apakah kota ini adalah pemilik jamu yang sedang diedit
                        $selected = ($row_kota['id_kota'] == $tampil['id_kota']) ? 'selected' : '';

                        echo '<option value="' . $row_kota['id_kota'] . '" ' . $selected . '>' . $row_kota['nama_kota'] . '</option>';
                    }
                    ?>
            </select>
            <label for="edited-email">Email</label>
            <input type="email" id="edited-email" name="email" value="<?php echo $tampil['email']; ?>" required>

            <button type="submit" name="submit">Update</button>
            <?php } ?>
        </form>
    </div>
</body>

</html>