<?php
require '../koneksi.php';
require './utils/crud.php';
require './utils/auth.php';
checkAuthentication();

$reservasiQuery = "SELECT COUNT(*) AS total_reservasi FROM reservasi";
$reservasiResult = readRecords($reservasiQuery);
$totalReservasi = $reservasiResult[0]['total_reservasi'];

$kritikSaranQuery = "SELECT COUNT(*) AS total_kritik_saran FROM kritiksaran";
$kritikSaranResult = readRecords($kritikSaranQuery);
$totalKritikSaran = $kritikSaranResult[0]['total_kritik_saran'];

$penaltiQuery = "SELECT COUNT(*) AS total_penalti FROM penalti";
$penaltiResult = readRecords($penaltiQuery);
$totalPenalti = $penaltiResult[0]['total_penalti'];

?>

<?php require_once 'header_template.php'; ?>

<main>
    <div class="head-title">
        <div class="left">
            <h1>Dashboard</h1>
        </div>
    </div>

    <ul class="box-info">
        <li>
            <i class='bx bxs-calendar-check'></i>
            <span class="text">
                <h3><?= $totalReservasi ?></h3>
                <p>Reservasi</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-message-dots'></i>
            <span class="text">
                <h3><?= $totalKritikSaran ?></h3>
                <p>Kritik dan Saran</p>
            </span>
        </li>
        <li>
            <i class='bx bxs-error'></i>
            <span class="text">
                <h3><?= $totalPenalti ?></h3>
                <p>Penalti</p>
            </span>
        </li>
    </ul>
</main>

<?php require_once 'footer_template.php'; ?>
