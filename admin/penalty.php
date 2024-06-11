<?php
require '../koneksi.php';
require './utils/crud.php';
require './utils/auth.php';
checkAuthentication();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_penalti = 'penalti-' . time();
    $pelanggaran = $_POST['pelanggaran'];
    $tanggal = $_POST['tanggal'];
    $id_user = $_POST['id_user'];

    $query = "INSERT INTO penalti (id_penalti, pelanggaran, tanggal, id_user) VALUES (?, ?, ?, ?)";
    $params = [$id_penalti, $pelanggaran, $tanggal, $id_user];

    try {
        createRecord($query, $params);
        $message = "success";
    } catch (Exception $e) {
        $message = "error";
    }
}

$penaltyQuery = "SELECT penalti.*, user.nama AS nama FROM penalti JOIN user ON penalti.id_user = user.id";
$penalties = readRecords($penaltyQuery);

$userQuery = "SELECT * FROM user";
$users = readRecords($userQuery);
?>

<?php require_once 'header_template.php'; ?>

<main>
    <div class="table-data">
        <div class="form-post">
            <div class="head">
                <h3>Penalti</h3>
            </div>

            <?php if (isset($message)): ?>
                <p><?php echo $message == "success" ? "Penalti berhasil ditambahkan." : "Terjadi kesalahan."; ?></p>
            <?php endif; ?>

            <form action="penalty.php" method="POST">
                <label for="pelanggaran">Penalti:</label>
                <input type="text" id="pelanggaran" name="pelanggaran" required>
                <br>
                <label for="tanggal">Tanggal:</label>
                <input type="date" id="tanggal" name="tanggal" required>
                <br>
                <label for="id_user">Pilih User:</label>
                <select id="id_user" name="id_user" required>
                    <option value="" disabled selected>Pilih User</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user['id']; ?>"><?= $user['nama']; ?></option>
                    <?php endforeach; ?>
                </select>
                <br>
                <button type="submit">Submit</button>
            </form>
        </div>

        <div class="order">
            <div class="head">
                <h3>Penalti</h3>
            </div>

            <?php if (empty($penalties)): ?>
                <p>Belum ada penalti.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Pelanggaran</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($penalties as $penalty): ?>
                            <tr>
                                <td><?= $penalty['nama']; ?></td>
                                <td><?= $penalty['pelanggaran']; ?></td>
                                <td><?= $penalty['tanggal']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php require_once 'footer_template.php'; ?>
