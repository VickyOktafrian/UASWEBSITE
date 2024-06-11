<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang</title>
    <link href='https://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Gugi' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #ac947ad1;
            margin: 0;
            font-family: 'Cuprum', sans-serif;
        }

        .content {
            max-width: 1200px;
            margin: 200px auto;
            padding: 20px;
        }

        .title h1 {
            font-size: 36px;
            font-family: 'Gugi', cursive;
            color: black;
            margin: 0 0 20px 0;
            text-align: left;
        }

        .lib1 {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .tentang1 {
            font-size: 24px;
            color: black;
            flex: 1;
            line-height: 1.5;
        }

        .tentang1 p {
            margin-bottom: 20px;
        }

        .lib1 img {
            margin-left: 100px;
            height: auto;
            width: 400px;
            border-radius: 15px;
            object-fit: cover;
        }

        .image-container {
            display: flex;
            flex-direction: column;
        }

        .image-container img {
            margin-bottom: 100px;
        }

        .image-container img:nth-child(2) {
            margin-left: 200px;
        }
        .image-container img:nth-child(4) {
            margin-left: 200px;
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
                    <li><a href="tentang.php" id="tentang">Tentang</a></li>
                    <li><a href="aktivitas.php">Aktivitas</a></li>
                    <li><a href="fasilitas.php">Fasilitas</a></li>
                    <li><a href="masuk.php" id="masuk">Masuk</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="title">
            <h1>Tentang <span style="color: #E8B021;">PemudaLIT</span></h1>
        </div>

        <div class="lib1">
            <div class="tentang1">
                <p><span id="tentangbiru">Perpustakaan Balai Pemuda</span> merupakan salah satu perpustakaan umum terbesar di Kota Surabaya dan terletak di jantung kota, tepatnya di Kompleks Gedung Balai Pemuda.</p>
                <p><span id="tentangbiru">Perpustakaan Balai Pemuda</span> berdiri sejak tahun 2013, melayani baca di tempat, pembuatan kartu anggota perpustakaan, peminjaman buku, kelas literasi, wisata buku dan masih banyak layanan lainnya.</p>
                <p><span id="tentangbiru">Perpustakaan Balai Pemuda</span> memiliki koleksi buku lebih dari 27 ribu buku yang terdiri dari berbagai macam genre buku. Fasilitas yang tersedia antara lain Ruang Baca dan tempat duduk, Children Library Room, Permainan Edukasi, English corner, Australia Corner, dan Korea Corner. Semua fasilitas tersebut dapat diakses secara gratis.</p>
                <br><br><br><h2>Visi, Misi, dan Motto <span style="color: #E8B021;">PemudaLIT</span></h2>
                <p><span style="color: #14308B;font-weight: bolder;">VISI</span><br>
                    MENJADIKAN SUMBER INFORMASI DAN MENCERDASKAN 
                    MASYARAKAT KOTA SURABAYA
                    </p>
                <p><span style="color: #14308B; font-weight: bolder;" >MISI</span><br>
                    <ul style="list-style: auto;">
                        <li >Membina dan mengembangkan koleksi perpustakaan</li>
                    <li>Membina dan mengembangkan kualitas pelayanan perpustakaan</li>
                    <li>Melestarikan koleksi sebagai hasil koleksi bangsa;</li>
                    <li>Membina dan mengembangkan jenis perpustakaan di lingkungan 
                        Pemerintah Kota Surabaya</li>
                    <li>Menyelenggarakan penyebaran informasi Kearsipan dan Perpustakaan</li>
                    </ul>
                    </p>
                    <p><span style="color: #14308B; font-weight: bolder;">MOTTO</span><br>
                    IKHLAS MELAYANI ANDA UNTUK MENJADI LEBIH CERDAS
                     </p>
            </div>
            <div class="image-container">
                <img src="asset/tentang1.jpg" alt="Library Image1">
                <img src="asset/tentang.jpg" alt="Library Image2">
                <img src="asset/tentang3.jpg" alt="Library Image3">
                <img src="asset/tentang4.jpg" alt="Library Image4">
            </div>
        </div>
    </div>

</body>
</html>
