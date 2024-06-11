<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivitas</title>
    <link href='https://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Gugi' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <style>
        body{
            background-color: #FAE9D9;
        }
        .menu ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }
        .menu ul li {
            margin-left: 20px;
        }
        .menu ul li a {
            text-decoration: none;
            color: #000;
            font-weight: bold;
        }
        .content {
            padding: 40px;
            text-align: center;
        }
        .content h1 {
            font-family: 'Gugi', cursive;
            font-size: 64px;
            color: #8b4513;
            margin-bottom: 40px;
            margin-top: 200px;
        }
        .activities {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .activity {
            width: 30%;
            margin-bottom: 40px;
        }
        .activity img {
            width: 360px;

            height: 200px;
            border-radius: 10px;
        }
        .activity p {
            margin-top: 10px;
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    <!--Menu Atas-->
    <nav>
        <div class="wrapper">
            <div class="logo">
                <a href="index.html"><img src="asset/logo.jpg" alt="PemudaLIT Logo" height="100px" width="300px"></a>
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

    <!--Konten-->
    <div class="content">
        <h1>AKTIVITAS</h1>
        <div class="activities">
            <div class="activity">
                <img src="asset/img1.jpg" alt="Kunjungan SDN Kaliasin">
                <p>Kunjungan SDN Kaliasin</p>
            </div>
            <div class="activity">
                <img src="asset/img2.jpg" alt="Lomba Mewarnai dan Kolase">
                <p>Lomba Mewarnai dan Kolase</p>
            </div>
            <div class="activity">
                <img src="asset/img3.jpg" alt="Wisata Buku Perpustakaan">
                <p>Wisata Buku Perpustakaan</p>
            </div>
            <div class="activity">
                <img src="asset/img4.jpg" alt="Bedah Buku">
                <p>Bedah Buku</p>
            </div>
            <div class="activity">
                <img src="asset/img5.jpg" alt="Kelas Literasi Bahasa Inggris">
                <p>Kelas Literasi Bahasa Inggris</p>
            </div>
            <div class="activity">
                <img src="asset/img6.jpg" alt="Kelas Literasi Disleksia">
                <p>Kelas Literasi Disleksia</p>
            </div>
        </div>
    </div>
</body>
</html>
