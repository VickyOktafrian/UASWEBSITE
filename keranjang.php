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
if (!$stmt) {
    die("Prepare statement failed: " . $conn->error);
}
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($nama);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang User</title>
    <link href='https://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Gugi' rel='stylesheet'>
    <link rel="stylesheet" href="styleuser.css">
    <style>
        .main-content {
            margin-top: 20px;
            margin-right: 10px;
            margin-left: 20%;
            float: right;
            flex: 1;
            padding: 20px;
        }

        .main-content h1 {
            font-size: 24px;
        }

        .main-content table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .main-content table, th, td {
            border: 1px solid #ddd;
        }

        .main-content th, td {
            padding: 8px;
            text-align: left;
        }

        .main-content th {
            background-color: #f2f2f2;
        }

        .btn-cancel {
            background-color: #ff4c4c;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .btn-cancel:hover {
            background-color: #ff0000;
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

    <!-- Main Container -->
    <div class="main-container">
        <!-- Main Content -->
        <div class="main-content">
            <h1>Pesanan Anda</h1>
            <p>Berhasil memproses reservasi. Anda dapat melihat semua reservasi yang telah anda proses disini. Reservasi dibawah ini tidak dapat dihapus secara otomatis oleh sistem, namun anda bisa membatalkannya dengan klik tombol 'Batalkan'.</p>
            
            <?php
            // Tampilkan pesan sukses atau kesalahan
            if (isset($_SESSION['message'])) {
                echo "<p>{$_SESSION['message']}</p>";
                unset($_SESSION['message']);
            }
            ?>
            
            <table>
                <thead>
                    <tr>
                        <th>Kode Reservasi</th>
                        <th>Reservasi</th>
                        <th>Nomor Kursi</th>
                        <th>Tujuan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT id_reservasi, tanggal, waktu, alasan, no_kursi FROM reservasi WHERE id_user = ?";
                    $stmt = $conn->prepare($sql);
                    if (!$stmt) {
                        die("Prepare statement failed: " . $conn->error);
                    }
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    $i = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $i++ . "</td>";
                        echo "<td>BK-" . date("dmY", strtotime($row['tanggal'])) . "-" . str_pad($row['id_reservasi'], 4, '0', STR_PAD_LEFT) . "</td>";
                        echo "<td>" . date("d F Y", strtotime($row['tanggal'])) . "</td>";
                        echo "<td>" . htmlspecialchars($row['no_kursi']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['alasan']) . "</td>";
                        echo '<td><button class="btn-cancel" onclick="cancelReservation(' . $row['id_reservasi'] . ')">Batalkan</button></td>';
                        echo "</tr>";
                    }
                    $stmt->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'cancel' && isset($_GET['id'])) {
        $id_reservasi = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $sql = "DELETE FROM reservasi WHERE id_reservasi =? AND id_user =?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Prepare statement failed: ". $conn->error);
        }
        $stmt->bind_param("ii", $id_reservasi, $user_id);
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $_SESSION['message'] = "Reservasi berhasil dibatalkan.";
            } else {
                $_SESSION['message'] = "Reservasi tidak ditemukan atau sudah dibatalkan.";
            }
        } else {
            $_SESSION['message'] = "Gagal membatalkan reservasi.";
        }
        $stmt->close();

        // Refresh the page to update the list
        header("Location: berandaUser.php");
        exit();

        }

        // Close the database connection
        $conn->close();
    ?>

    <script>
        function cancelReservation(id) {
            if (confirm('Anda yakin ingin membatalkan reservasi ini?')) {
                window.location.href = 'reservasi.php?action=cancel&id=' + id;
            }
        }
    </script>
</body>
</html>
