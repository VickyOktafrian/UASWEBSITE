<?php
require '../koneksi.php';
require './utils/crud.php';
require './utils/auth.php';
checkAuthentication();

$query = "SELECT * FROM kritiksaran";
$datas = readRecords($query);
?>

<?php require_once 'header_template.php'; ?>

<main>
    <div class="table-data">
        <div class="order">
            <div class="head">
                <h3>Kritik dan Saran</h3>
            </div>
            
            <?php if(empty($datas)) { ?>
                <p>Belum ada kritik dan saran.</p>
            <?php } else { ?>
                <table>
                    <thead>
                        <tr>
                            <th>Kategori</th>
                            <th>Pesan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datas as $data) { ?>
                            <tr>
                                <td><?= $data['kategori']; ?></td>
                                <td><?= $data['isi']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>
</main>

<?php require_once 'footer_template.php'; ?>

