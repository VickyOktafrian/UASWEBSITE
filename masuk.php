<?php
ob_start();
session_start();
if (isset($_POST["masuk"])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    require_once "koneksi.php";

    function check_login($conn, $sql, $email, $password, $redirect_page, $is_admin = false) {
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            mysqli_stmt_close($stmt);

            if ($user) {
                if ($is_admin) {
                    if ($password === $user["password"]) {
                        $_SESSION['admin_username'] = $user['username'];
                        $_SESSION['admin_email'] = $user['email'];
                        header("Location: $redirect_page");
                        exit();
                    } else {
                        echo "<script>alert('Password Anda Salah');</script>";
                        return true;
                    }
                } else {
                    if (password_verify($password, $user["password"])) {
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['email'] = $user['email'];
                        header("Location: $redirect_page");
                        exit();
                    } else {
                        echo "<script>alert('Password Anda Salah');</script>";
                        return true;
                    }
                }
            } else {
                echo "<script>console.log('User not found');</script>";
            }
        } else {
            echo "<script>console.log('Query preparation failed');</script>";
        }
        return false;
    }

    $sql_user = "SELECT * FROM user WHERE email = ?";
    $sql_admin = "SELECT * FROM admin WHERE email = ?";


    $email_exists = false;


    if (check_login($conn, $sql_user, $email, $password, "berandaUser.php")) {
        $email_exists = true;
    }


    if (!$email_exists && check_login($conn, $sql_admin, $email, $password, "admin", true)) {
        $email_exists = true;
    }


    if (!$email_exists) {
        echo "<script>alert('Email Tidak Terdaftar');</script>";
    }
    mysqli_close($conn);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Gugi' rel='stylesheet'>
    <style>
        .gambarperpus {
            margin-top: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 860px;
            width: 100%;
            background-size: cover;
            position: relative;
            background-image: url('asset/bg masuk.jpg');
            background-repeat: no-repeat;
            background-position: center center;
        }
        .masuk {
            width: 521px;
            height: 540px;
            border-radius: 33px;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .masuk p.title {
            color: #14308B;
            font-size: 40px;
            margin-bottom: 50px;
        }
        .masuk form {
            width: 100%;
        }
        .masuk label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-weight: lighter;
            font-family: "Cuprum";
        }
        .masuk input[type="text"],
        .masuk input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            font-family: "Cuprum";
            font-weight: lighter;
        }
        .masuk input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: #FFCD1C;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            font-family: "Cuprum";
            font-weight: bold;
        }
        .masuk input[type="submit"]:hover {
            background: #caa316;
        }
        .masuk .ingat-wrapper {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        #ingat {
            margin-right: 10px;
            width: 30px;
            height: 30px;
            border-radius: 100%;
        }
        .masuk p.ingat-saya {
            font-family: "Cuprum";
            font-size: 20px;
            font-weight: lighter;
            margin: 0;
        }
    </style>
</head>
<body>

 
    <!--Menu Atas-->
    <nav>
        <div class="wrapper">
            <div class="logo">
                <a href="index.html"><img src="asset/logo.jpg" height="100px" width="300px" alt="PemudaLIT Logo"></a>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="index.html">Beranda</a></li>
                    <li><a href="tentang.php">Tentang</a></li>
                    <li><a href="aktivitas.php">Aktivitas</a></li>
                    <li><a href="fasilitas.php">Fasilitas</a></li>
                    <li><a href="masuk.php" id="masuk">Masuk</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="gambarperpus">

        <div class="masuk">
            <p class="title">Masuk ke Akunmu</p>
            <form action="masuk.php" method="POST">
                <label for="email">Email/Telepon</label>
                <input type="text" id="email" name="email">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
                <div class="ingat-wrapper">
                    <input type="checkbox" value="Ingat Saya" id="ingat">
                    <label for="ingat" id="ingat-label"></label>
                    <p class="ingat-saya">ingat saya</p>
                </div>
                <input type="submit" value="Masuk" name="masuk">
                <p style="float: left; margin-top: 5px;">Belum Punya Akun? <a href="Daftar Akun.php">Daftar disini</a></p>
            </form>

        </div>
    </div>
</body>
</html>
