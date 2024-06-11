<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasilitas</title>
    <link href='https://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Gugi' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <style>
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
        .gambarperpus {
            position: relative;
            text-align: center;
            color: white;
        }
        .gambarperpus img {
            width: 100%;
            height: auto;
        }
        .tulisan {
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: left;
            color: #14308B;
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            width: 60%;
            margin-top: 200px;
        }
        .tulisan h1 {
            font-size: 64px;
            font-family: 'Gugi', cursive;
            margin-bottom: 20px;
        }
        .tulisan .content {
            display: flex;
            justify-content: space-between;
        }
        .tulisan .content div {
            width: 30%;
        }
        .tulisan .content h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .tulisan .content ul {
            list-style: none;
            padding: 0;
        }
        .tulisan .content ul li {
            margin-bottom: 10px;
            font-size: 18px;
            color: black;
            list-style: circle;
        }
        .jam-operasional {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
        .jam-operasional h1 {
            color: black;
            margin-bottom: 10px;
        }
        .jam-operasional img {
            border: 1px solid;
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
                    <li><a href="fasilitas.php" id="home">Fasilitas</a></li>
                    <li><a href="masuk.php" id="masuk">Masuk</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="gambarperpus">
        <img src="https://officesnapshots.com/wp-content/uploads/2022/08/office-link-coworking-offices-istanbul-1200x1139-compact.jpg" alt="Coworking Space">
        <div class="tulisan">
            <h1>FASILITAS</h1>
            <div class="content">
                <div class="fasilitas">
                    <h2>Beberapa fasilitas yang tersedia, diantaranya :</h2>
                    <ul>
                        <li>Akses gedung dan internet</li>
                        <li>Coworking space untuk umum</li>
                        <li>Tempat membaca untuk anak-anak</li>
                        <li>Tersedia PC untuk umum dan anak</li>
                        <li>Ruangan bertema kultur luar negeri</li>
                        <li>Proyektor dan layar</li>
                        <li>Setiap sudut ruangan dilengkapi dengan AC</li>
                    </ul>
                </div>
                <div class="layanan">
                    <h2>Program Layanan :</h2>
                    <ul>
                        <li>Wisata buku (bagi sekolah TK/PAUD, SD, SMP)</li>
                        <li>Bimbingan belajar gratis</li>
                        <li>Program pembelajaran khusus Disleksia</li>
                    </ul>
                </div>
                <div class="media-sosial">
                    <h2>Media Sosial :</h2>
                    <ul>
                        <li>Instagram : @perpusbalpem</li>
                        <li>No Telp : 031-99277696</li>
                    </ul>
                </div>
            </div>
            <div class="jam-operasional">
                <h1>Jam Operasional Layanan</h1>
                <img src="asset/jamop.jpg" alt="Jam Operasional" width="544px" height="65px">
            </div>
        </div>
    </div>
</body>
</html>
