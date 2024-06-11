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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal = $_POST['date'];
    $waktu = $_POST['time'];
    $alasan = $_POST['purpose'];
    $no_kursi = $_POST['seat'];

    $sql = "INSERT INTO reservasi (id_user, tanggal, waktu, alasan, no_kursi) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $user_id, $tanggal, $waktu, $alasan, $no_kursi);

    if ($stmt->execute()) {
        echo "<script>alert('Reservasi berhasil!');</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan, silakan coba lagi.');</script>";
    }
    $stmt->close();
}

// Fetch booked seats from the database
$booked_seats = array();
$sql_booked_seats = "SELECT no_kursi FROM reservasi WHERE tanggal = ? AND waktu = ?";
$stmt_booked_seats = $conn->prepare($sql_booked_seats);
$stmt_booked_seats->bind_param("ss", $tanggal, $waktu);
$stmt_booked_seats->execute();
$stmt_booked_seats->bind_result($booked_seat);
while ($stmt_booked_seats->fetch()) {
    $booked_seats[] = $booked_seat;
}
$stmt_booked_seats->close();

$conn->close();
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
            <li><a href="reservasi.php" id="klik">Reservasi</a></li>
            <li><a href="ks.php">Kritik dan Saran</a></li>
            <li><a href="penalti.php">Penalty</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="reservation-form">
            <h2>Reservasi</h2>
            <form method="POST" action="reservasi.php">
                <label for="date">Pilih Tanggal:</label>
                <input type="date" id="date" name="date" required>
                <label for="time">Pilih Waktu:</label>
                <input type="time" id="time" name="time" required>
                <input type="text" id="purpose" name="purpose" placeholder="Tujuan Reservasi" required>
                <label for="seat">Pilih Nomor Kursi:</label>
                <select id="seat" name="seat" required>
                    <option value="">Pilih Kursi</option>
                    <?php
                    $rows = range('A', 'D');
                    $cols = range(1, 10);
                    foreach ($rows as $row) {
                        foreach ($cols as $col) {
                            $seat = $row . $col;
                            $seat_class = in_array($seat, $booked_seats) ? 'class="booked"' : '';
                            echo "<option value='$seat' $seat_class>$seat</option>";
                        }
                    }
                    ?>
                </select>
                <br><br>
                <div class="buttons">
                    <button type="submit" class="btn-green">Reservasi</button>
                    <button type="button" class="btn-red" onclick="window.history.back();">Kembali</button>
                </div>
            </form>

            <div class="color-info">
                <h3>Keterangan Warna :</h3>
                <p><span class="color-red"></span> Merah: Kursi sudah dibooking</p>
                <p><span class="color-black"></span> Hitam: Kursi tersedia</p>
            </div>
        </div>
        <div class="reservation-seats">
            <h3>Ruang Duduk dan Co-working Space</h3>
            <p>Silahkan memilih salah satu nomor tempat di bawah ini dengan mengklik salah satu nomor tempat tersebut.</p>
            <div class="seating-layout">
                <?php
                foreach ($rows as $row) {
                    foreach ($cols as $col) {
                        $seat = $row . $col;
                        // Check if the seat is booked
                        $seat_class = in_array($seat, $booked_seats) ? 'booked' : '';
                        echo "<button class='seat $seat_class' id='$seat' onclick='selectSeat(\"$seat\")'>$seat</button>";
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        function selectSeat(seatId) {
            document.getElementById('seat').value = seatId;
        }
        
        document.addEventListener('DOMContentLoaded', function () {
            const seats = document.querySelectorAll('.seat');
            
            seats.forEach(seat => {
                seat.addEventListener('click', function () {
                    if (!this.classList.contains('booked')) {
                        if (this.classList.contains('selected')) {
                            this.classList.remove('selected');
                        } else {
                            seats.forEach(s => s.classList.remove('selected'));
                            this.classList.add('selected');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>

