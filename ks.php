<?php
session_start();
require_once 'koneksi.php';

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
  header("Location: masuk.php");
  exit();
}

// Ambil informasi pengguna dari database
$user_id = $_SESSION['user_id'];
$sql = "SELECT nama FROM user WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($nama);
$stmt->fetch();
$stmt->close();

// Handle form submission
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kategori = $_POST['kategori'];
    $isi = $_POST['isi'];
  
    $sql = "INSERT INTO kritiksaran (kategori, isi) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $kategori, $isi); // Menggunakan "ss" untuk tipe data string
  
    if ($stmt->execute()) {
      echo "<script>alert('Terimakasih atas kritik dan sarannya');</script>";
    } else {
      echo "<script>alert('Terjadi kesalahan, silakan coba lagi.');</script>";
    }
    $stmt->close();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi User</title>
    <link href='https://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Gugi' rel='stylesheet'>
    <link rel="stylesheet" href="styleuser.css">
    <style>
        .seating-layout {
            display: grid;
            grid-template-columns: repeat(10, 1fr);
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }
        .seat {
            background-color: #34495e;
            color: white;
            border: none;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            cursor: pointer;
        }
        .seat.selected {
            background-color: red;
        }
        .seat.booked {
            background-color: red; /* Perubahan warna untuk kursi yang sudah dipesan */
        }
        .color-info {
            text-align: left;
            margin-top: 20px;
        }
        .color-red, .color-black {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 5px;
            vertical-align: middle;
        }
        .color-red {
            background-color: red;
        }
        .color-black {
            background-color: black;
        }
        form {
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav>
        <div class="logo">
            <img src="asset/logo.jpg" alt="PemudaLIT Logo">
        </div>
        <div class="menu">
            <ul>
                <li><a href="keranjang.php"><img src="https://cdn.kibrispdr.org/data/640/ikon-keranjang-belanja-4.png" alt="Keranjang"></a></li>

                <li>   
                    <div class="user-icon" id="userIcon">
                    <img src="https://media.istockphoto.com/id/1332100919/id/vektor/ikon-manusia-ikon-hitam-simbol-orang.jpg?s=612x612&w=0&k=20&c=DuLvR5pRI1dJf4wkP6ezTaqw7DsVb4cNIglgDLwQo5E=" alt="User" height="37px" width="auto">
                    <div class="popup" id="popupMenu">
                        <a href="profil.php">Profile</a>
                        <a href="masuk.php">Logout</a>
                    </div>
                    </div>

                <script>
                    document.getElementById('userIcon').addEventListener('click', function() {
                        var popup = document.getElementById('popupMenu');
                        popup.style.display = popup.style.display === 'block' ? 'none' : 'block';
                    });

                    document.addEventListener('click', function(event) {
                        var isClickInside = document.getElementById('userIcon').contains(event.target);
                        if (!isClickInside) {
                            document.getElementById('popupMenu').style.display = 'none';
                        }
                    });
                </script>
                </li>
                <li><span><?php echo htmlspecialchars($nama); ?></span></li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>PemudaLIT</h2>
        <ul>
            <li><a href="berandaUser.php">Dashboard</a></li>
            <li><a href="reservasi.php" >Reservasi</a></li>
            <li><a href="ks.php" id="klik">Kritik dan Saran</a></li>
            <li><a href="penalti.php">Penalty</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
    <div class="reservation-form"> <h2>Kritik dan Saran</h2> <form method="POST" action="ks.php"> <label for="kategori">Pilih Kategori:</label><br> <select id="kategori" name="kategori" required> <option value="layanan">Layanan</option> <option value="fasilitas">Fasilitas</option> </select> <br><br> <label for="isi">Kritik/Saran:</label><br> <textarea id="isi" name="isi" rows="5" cols="50" required></textarea> <br><br> <div class="buttons"> <button type="submit" class="btn-green">Kirim</button> </div> </form>
    </div>
    </div>


</body>
</html>

