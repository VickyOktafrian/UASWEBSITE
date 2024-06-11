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

// Fetch total reservations for the logged-in user
$sql = "SELECT COUNT(*) AS total FROM reservasi WHERE id_user = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($total_reservasi);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda User</title>
    <link href='https://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Gugi' rel='stylesheet'>
    <link rel="stylesheet" href="styleuser.css">
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
            <li><a id="klik" href="berandaUser.php">Dashboard</a></li>
            <li><a href="reservasi.php">Reservasi</a></li>
            <li><a href="ks.php">Kritik dan Saran</a></li>
            <li><a href="penalti.php">Penalty</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Dashboard Cards -->
        <div class="dashboard">
            <div class="card" id="total-reservasi-card">
                <h3>0</h3>
                <p>Total Reservasi</p>
                <p class="update-time" id="total-reservasi-time">Update : just now</p>
            </div>
            <div class="card blue" id="belum-checkin-card">
                <h3>0</h3>
                <p>Belum Check In</p>
                <p class="update-time" id="belum-checkin-time">Update : just now</p>
            </div>
            <div class="card blue" id="checkin-card">
                <h3>0</h3>
                <p>Check In</p>
                <p class="update-time" id="checkin-time">Update : just now</p>
            </div>
            <div class="card" id="total-reservasi-2-card">
                <h3>0</h3>
                <p>Total Reservasi</p>
                <p class="update-time" id="total-reservasi-2-time">Update : just now</p>
            </div>
        </div>

        <!-- Welcome Message -->
        <div class="welcome-message">
            <p>Selamat Datang.</p>
            <p id="user-info">Your IP Address : <span id="ip-address">Loading...</span> | Your Browser : <span id="browser"></span> | Your Platform : <span id="platform"></span> | Login as : <?php echo htmlspecialchars($nama); ?></p>
        </div>
    </div>

    <script>
        const totalReservasi = <?php echo $total_reservasi; ?>;

        document.addEventListener('DOMContentLoaded', function() {
            async function updateIPAddress() {
                try {
                    const response = await fetch('https://api.ipify.org?format=json');
                    const data = await response.json();
                    document.getElementById('ip-address').innerText = data.ip;
                } catch (error) {
                    console.error('Error fetching IP address:', error);
                    document.getElementById('ip-address').innerText = 'Unable to retrieve IP address';
                }
            }

            function updateBrowserInfo() {
                const userAgent = navigator.userAgent;
                let browser = 'Unknown Browser';

                if (userAgent.indexOf('Firefox') > -1) {
                    browser = 'Mozilla Firefox';
                } else if (userAgent.indexOf('SamsungBrowser') > -1) {
                    browser = 'Samsung Internet';
                } else if (userAgent.indexOf('Opera') > -1 || userAgent.indexOf('OPR') > -1) {
                    browser = 'Opera';
                } else if (userAgent.indexOf('Trident') > -1) {
                    browser = 'Microsoft Internet Explorer';
                } else if (userAgent.indexOf('Edge') > -1) {
                    browser = 'Microsoft Edge';
                } else if (userAgent.indexOf('Chrome') > -1) {
                    browser = 'Google Chrome';
                } else if (userAgent.indexOf('Safari') > -1) {
                    browser = 'Safari';
                }

                document.getElementById('browser').innerText = browser;
                document.getElementById('platform').innerText = navigator.platform;
            }

            function updateTime() {
                const now = new Date().toLocaleString();
                document.querySelectorAll('.update-time').forEach(el => {
                    el.innerText = `Update : ${now}`;
                });
            }

            updateIPAddress();
            updateBrowserInfo();
            updateTime();

            // Update the total reservations count
            document.getElementById('total-reservasi-card').querySelector('h3').innerText = totalReservasi;

            setInterval(updateTime, 60000);
        });
    </script>
</body>
</html>
