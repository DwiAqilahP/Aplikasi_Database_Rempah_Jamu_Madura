<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jamu Madura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        /* CSS untuk mengatur tampilan gambar, teks, dan tombol */
        body,
        html {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }

        #slideshow-container {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .mySlides {
            display: none;
            text-align: center;
        }

        img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .welcome-text {
            position: absolute;
            top: 40%; /* Mengubah top menjadi 50% */
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 60px;
            color: #ffffff;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px 20px;
            font-style: italic;
        }

        .login-button {
            position: absolute;
            bottom: 100px; /* Mengubah bottom menjadi 20px */
            left: 50%;
            transform: translateX(-50%);
            padding: 15px 30px;
            background-color: #FFFFFF;
            color: #C8A287;
            border: none;
            cursor: pointer;
            font-size: 20px;
        }

        .login-button:hover {
            background-color: #FFFBF5;
        }

        /* Menambahkan media query untuk layar berukuran kecil (HP) */
        @media (max-width: 768px) {
            .welcome-text {
                font-size: 40px;
            }

            .login-button {
                font-size: 16px;
            }
        }
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
            <!-- Tombol toggle untuk tampilan responsif pada layar kecil -->
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
    <div id="slideshow-container">
        <!-- Gambar pertama dengan tulisan "Selamat Datang" -->
        <div class="mySlides">
            <img src="gambar/home1.png" alt="Gambar 1">
            <div class="welcome-text">Aplikasi Database Rempah untuk Produksi Jamu Madura</div>
            <a href="login.php"><button class="login-button"> Masuk</button></a>
        </div>

        <!-- Gambar kedua dengan tulisan "Selamat Datang" -->
        <div class="mySlides">
            <img src="gambar/home2.png" alt="Gambar 2">
            <div class="welcome-text">Aplikasi Database Rempah untuk Produksi Jamu Madura</div>
            <button class="login-button">Masuk</button>
        </div>
         <div class="mySlides">
            <img src="gambar/home3.png" alt="Gambar 2">
            <div class="welcome-text">Aplikasi Database Rempah untuk Produksi Jamu Madura</div>
            <button class="login-button">Masuk</button>
        </div>
         <div class="mySlides">
            <img src="gambar/home4.png" alt="Gambar 2">
            <div class="welcome-text">Aplikasi Database Rempah untuk Produksi Jamu Madura</div>
            <button class="login-button">Masuk</button>
        </div>
    </div>

    <script>
    // JavaScript untuk mengatur perpindahan gambar secara otomatis
    var slideIndex = 0;
    carousel();

    function carousel() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1;
        }
        slides[slideIndex - 1].style.display = "block";
        setTimeout(carousel, 5000); // Ganti gambar setiap 5 detik
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>

</html>
