<!DOCTYPE html>
<html>

<head>
    <title>Edit Komposisi Jamu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
        }

        form {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 30px;
        }

        select,
        input[type="checkbox"] {
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        .checkbox-label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        .checkbox-input {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <h1>Edit Komposisi Jamu</h1>
    <?php
    include "../koneksi.php";
    $id_jamu = $_GET['id_jamu'];
    if (isset($_POST['submit'])) {
        $khasiat = $_POST['khasiat'];
        $rempah = $_POST['rempah'];

        $query_delete_khasiat = "DELETE FROM khasiat_jamu WHERE id_jamu = '$id_jamu'";
        mysqli_query($mysqli, $query_delete_khasiat);

        foreach ($khasiat as $id_khasiat) {
            $query_insert_khasiat = "INSERT INTO khasiat_jamu (id_jamu, id_khasiat) VALUES ('$id_jamu', '$id_khasiat')";
            mysqli_query($mysqli, $query_insert_khasiat);
        }

        $query_delete_rempah = "DELETE FROM komposisi WHERE id_jamu = '$id_jamu'";
        mysqli_query($mysqli, $query_delete_rempah);

        foreach ($rempah as $id_rempah) {
            $query_insert_rempah = "INSERT INTO komposisi (id_jamu, id_rempah) VALUES ('$id_jamu', '$id_rempah')";
            mysqli_query($mysqli, $query_insert_rempah);
        }

        header("Location: dashboard.php");
    }

    $query_jamu = "SELECT * FROM jamu WHERE id_jamu = '$id_jamu'";
    $result_jamu = mysqli_query($mysqli, $query_jamu);

    while ($tampil_jamu = mysqli_fetch_array($result_jamu)) {
    ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <label for="jamu">Pilih Jamu:</label>
            <input type="text" name="nama_jamu" value="<?= $tampil_jamu['nama_jamu']; ?>" readonly>
            <hr>
            <label>Pilih Khasiat:</label>
            <input type="text" id="searchKhasiat" placeholder="Cari khasiat...">
            <div id="khasiatList">
                <?php
                $query_khasiat = "SELECT * FROM khasiat";
                $result_khasiat = mysqli_query($mysqli, $query_khasiat);

                while ($row_khasiat = mysqli_fetch_assoc($result_khasiat)) {
                    $query_selected = "SELECT COUNT(*) AS selected FROM khasiat_jamu WHERE id_jamu = '$id_jamu' AND id_khasiat = '" . $row_khasiat['id_khasiat'] . "'";
                    $result_selected = mysqli_query($mysqli, $query_selected);
                    $selected_data = mysqli_fetch_assoc($result_selected);

                    $isChecked = ($selected_data['selected'] > 0) ? 'checked' : '';

                    echo "<div class='checkbox-label'><input type='checkbox' class='checkbox-input' name='khasiat[]' value='" . $row_khasiat['id_khasiat'] . "' $isChecked>" . $row_khasiat['khasiat'] . "</div>";
                }
                ?>
            </div>

            <hr>
            <label for="rempah">Pilih Rempah:</label>
            <input type="text" id="searchRempah" placeholder="Cari rempah...">
            <div id="rempahList">
                <?php
                $query_rempah = "SELECT * FROM rempah";
                $result_rempah = mysqli_query($mysqli, $query_rempah);

                while ($row_rempah = mysqli_fetch_assoc($result_rempah)) {
                    $query_selected_rempah = "SELECT COUNT(*) AS selected_rempah FROM komposisi WHERE id_jamu = '$id_jamu' AND id_rempah = '" . $row_rempah['id_rempah'] . "'";
                    $result_selected_rempah = mysqli_query($mysqli, $query_selected_rempah);
                    $selected_rempah_data = mysqli_fetch_assoc($result_selected_rempah);

                    $isCheckedRempah = ($selected_rempah_data['selected_rempah'] > 0) ? 'checked' : '';

                    echo "<div class='checkbox-label'><input type='checkbox' class='checkbox-input' name='rempah[]' value='" . $row_rempah['id_rempah'] . "' $isCheckedRempah>" . $row_rempah['nama_rempah'] . "</div>";
                }
                ?>
            </div>

            <input type="submit" name="submit" value="Simpan">
        </form>
    <?php } ?>
    <script>
        document.getElementById('searchKhasiat').addEventListener('input', function () {
            let filter = this.value.toLowerCase();
            let khasiatList = document.getElementById('khasiatList');
            let khasiatItems = khasiatList.getElementsByClassName('checkbox-label');

            for (let i = 0; i < khasiatItems.length; i++) {
                let item = khasiatItems[i];
                let text = item.textContent || item.innerText;
                if (text.toLowerCase().indexOf(filter) > -1) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            }
        });

        document.getElementById('searchRempah').addEventListener('input', function () {
            let filter = this.value.toLowerCase();
            let rempahList = document.getElementById('rempahList');
            let rempahItems = rempahList.getElementsByClassName('checkbox-label');

            for (let i = 0; i < rempahItems.length; i++) {
                let item = rempahItems[i];
                let text = item.textContent || item.innerText;
                if (text.toLowerCase().indexOf(filter) > -1) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            }
        });
    </script>
</body>

</html>
