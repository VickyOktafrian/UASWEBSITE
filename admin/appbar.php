<section id="sidebar">
    <a href="#" class="brand">
        <i class='bx bxs-smile'></i>
        <span class="text">Admin</span>
    </a>
    <ul class="side-menu top">
        <li class="<?= basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : '' ?>">
            <a href="index.php">
                <i class='bx bxs-dashboard' ></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li class="<?= basename($_SERVER['PHP_SELF']) === 'reservasi.php' ? 'active' : '' ?>">
            <a href="reservasi.php">
                <i class='bx bxs-calendar-check' ></i>
                <span class="text">Reservasi</span>
            </a>
        </li>
        <li class="<?= basename($_SERVER['PHP_SELF']) === 'kritik_saran.php' ? 'active' : '' ?>">
            <a href="kritik_saran.php">
                <i class='bx bxs-message-dots' ></i>
                <span class="text">Kritik dan Saran</span>
            </a>
        </li>
        <li class="<?= basename($_SERVER['PHP_SELF']) === 'penalty.php' ? 'active' : '' ?>">
            <a href="penalty.php">
                <i class='bx bxs-error' ></i>
                <span class="text">Penalti</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
            <a href="logout.php" class="logout">
                <i class='bx bxs-log-out-circle' ></i>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>
</section>

<section id="content">
    <nav>
        <div class="menu">
            <i class='bx bx-menu' ></i>
            <a href="#" class="nav-link">PemudaLIT</a>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
        </div>
        <div class="username">
            <i class='bx bxs-user' ></i>
            <span class="name"><?= $_SESSION['admin_username']; ?></span>
        </div>
    </nav>
