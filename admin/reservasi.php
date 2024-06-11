<?php
require '../koneksi.php';
require './utils/crud.php';
require './utils/auth.php';
checkAuthentication();

$query = "SELECT reservasi.*, user.nama AS nama FROM reservasi JOIN user ON reservasi.id_user = user.id";
$result = readRecords($query);
?>

<?php require_once 'header_template.php'; ?>

<main>
    <div class="table-data">
        <?php if(empty($result)) { ?>
            <p>Belum ada reservasi.</p>
        <?php } else { ?>
            <div class="order">
                <div class="head">
                    <h3>Reservasi</h3>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Alasan</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Kursi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $reservasi) { ?>
                            <tr>
                                <td><p><?= $reservasi['nama']; ?></p></td>
                                <td><?= $reservasi['alasan']; ?></td>
                                <td><?= $reservasi['tanggal']; ?></td>
                                <td><?= $reservasi['waktu']; ?></td>
                                <td><?= $reservasi['no_kursi']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</main>

<?php require_once 'footer_template.php'; ?>

