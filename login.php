<?php 
 
include 'koneksi.php';
 
error_reporting(0);
 
session_start();
 
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    $sql = "SELECT * FROM user WHERE username='$username' AND pw='$password'";
    $result = mysqli_query($mysqli, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['pw'] = $row['pw'];
        
        if($row["username"]== "admin"){
            header("Location: admin/dashboard.php");
        }else{
            header("Location: user/dashboard.php");
        }
    } else {
        echo "<script>alert('username atau password Anda salah. Silahkan coba lagi!')</script>";
    }
}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="#" method="POST">
            <div class="input-field">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="submit">Masuk</button>
        </form>
        <br>
        <p>belum punya akun? <a href="register.php">Register</a></p>
    </div>

</body>
</html>
