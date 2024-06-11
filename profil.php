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
$sql = "SELECT nama, email FROM user WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($nama, $email);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link href='https://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Gugi' rel='stylesheet'>
    <link rel="stylesheet" href="styleuser.css">
    <style>
        .main-content {
            padding: 20px;
            width: calc(100% - 260px); /* Adjust according to sidebar width */
            margin-left: 260px; /* Adjust according to sidebar width */
            margin-top: 100px;
        }
        .profile-header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .profile-pic img {
            height: 150px;
            width: 150px;
            border-radius: 50%;
            margin-right: 20px;
            border: 3px solid #4CAF50;
        }
        .profile-info h1, .profile-info p {
            margin: 0;
            font-family: 'Gugi', sans-serif;
        }
        .profile-info p {
            color: #555;
        }
        .profile-details {
            text-align: center;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .profile-details table {
            margin: 0 auto;
            border-collapse: collapse;
        }
        .profile-details td {
            padding: 10px 20px;
            border: 1px solid #ddd;
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
            <li><a href="reservasi.php">Reservasi</a></li>
            <li><a href="ks.php">Kritik dan Saran</a></li>
            <li><a href="penalti.php">Penalty</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="profile-header">
            <div class="profile-pic">
                <img src="https://ik.imagekit.io/tvlk/blog/2020/01/shutterstock_404607271.jpg" alt="Profile Picture">
            </div>
            <div class="profile-info">
                <h1><?php echo htmlspecialchars($nama); ?></h1>
                <p><?php echo htmlspecialchars($email); ?></p>
            </div>
        </div>
        <div class="profile-details">
            <h2>Tentang Saya</h2>
            <table>
                <tr>
                    <td>Akun</td>
                    <td><?php echo htmlspecialchars($nama); ?></td>
                </tr>
                <tr>
                    <td>Email/Telepon</td>
                    <td><?php echo htmlspecialchars($email); ?></td>
                </tr>

            </table>
        </div>
    </div>
</body>
</html>
