<?php
if (isset($_POST["daftar"])) {
    $fullname = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $errors = array();
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Validate input fields
    if (empty($fullname) || empty($email) || empty($password)) {
        array_push($errors, "Tidak Boleh Ada Kolom yang Kosong");
    }

    // Check if there are errors and display them
    if (count($errors) > 0) {
        echo "<script>";
        foreach ($errors as $error) {
            echo "alert('$error');";
        }
        echo "</script>";
    } else {
        // Include the database connection file
        require_once "koneksi.php";
        
        // Prepare the SQL statement
        $sql = "INSERT INTO user (nama, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        $preparestmt = mysqli_stmt_prepare($stmt, $sql);
        
        if ($preparestmt) {
            // Bind parameters and execute statement
            mysqli_stmt_bind_param($stmt, "sss", $fullname, $email, $passwordHash);
            mysqli_stmt_execute($stmt);
            echo "<script>alert('Anda Berhasil Terdaftar'); window.location.href='masuk.php';</script>";
        } else {
            die("Something went wrong: " . mysqli_error($conn));
        }
        
        // Close the statement and connection
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet'>

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
            background-image: url('https://uiii.ac.id/assets/images/1636690539-alfons-morales-YLSwjSy7stw-unsplash-2.jpg');
            background-repeat: no-repeat;
            background-position: center center;
        }
        .masuk {
            width: 521px;
            height: auto;
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
            <p class="title">Pendaftaran Pengguna Umum PemudaLIT</p>
            <form method="POST" action="">
                <label for="nama">Nama Pengguna</label>
                <input type="text" id="nama" name="nama">
                <label for="email">Email/Telepon</label>
                <input type="text" id="email" name="email">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
                <input type="submit" value="Daftar" name="daftar">
                <p style="float: left; margin-top: 5px;">Sudah Punya Akun? <a href="masuk.php">Masuk disini</a></p>
            </form>
        </div>
    </div>
</body>
</html>
