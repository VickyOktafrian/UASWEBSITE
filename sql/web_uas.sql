-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jun 2024 pada 13.57
-- Versi server: 11.3.2-MariaDB
-- Versi PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_uas`
--`web_uas`

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `email` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`email`, `password`, `username`) VALUES
('admin', 'admin', 'ADMIN'),
('yasir@gmail.com', '123', 'yasir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kritiksaran`
--

CREATE TABLE `kritiksaran` (
  `kategori` VARCHAR(255) DEFAULT NULL,
  `isi` VARCHAR(255) DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kritiksaran`
--

INSERT INTO `kritiksaran` (`kategori`, `isi`) VALUES
('layanan', 'Tes'),
('layanan', 'Jelek');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penalti`
--

CREATE TABLE `penalti` (
  `id_penalti` CHAR(20) NOT NULL,
  `pelanggaran` VARCHAR(255) DEFAULT NULL,
  `tanggal` DATE DEFAULT NULL,
  `id_user` INT(11) DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penalti`
--

INSERT INTO `penalti` (`id_penalti`, `pelanggaran`, `tanggal`, `id_user`) VALUES
('penalti-1718026138', 'Merusak buku', '2024-06-02', 6),
('penalti-1718027774', 'Merusak buku', '2024-06-10', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservasi`
--

CREATE TABLE `reservasi` (
  `id_user` INT(11) DEFAULT NULL,
  `tanggal` DATE NOT NULL,
  `id_reservasi` INT(11) NOT NULL,
  `waktu` TIME NOT NULL,
  `alasan` VARCHAR(255) NOT NULL,
  `no_kursi` VARCHAR(255) NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `reservasi`
--

INSERT INTO `reservasi` (`id_user`, `tanggal`, `id_reservasi`, `waktu`, `alasan`, `no_kursi`) VALUES
(3, '2024-06-04', 13, '21:30:00', 'asdas', 'B8'),
(5, '2024-06-07', 14, '17:30:00', 'belajar', 'C6'),
(7, '2024-06-13', 15, '01:19:00', 'T', 'D10'),
(7, '2024-06-10', 16, '20:56:00', 'Belajar ', 'B4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `email` VARCHAR(255) NOT NULL,
  `nama` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `id` INT(11) NOT NULL,
  `id_resevasi` INT(11) DEFAULT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`email`, `nama`, `password`, `id`, `id_resevasi`) VALUES
('vickygamers46@gmail.com', 'Muhamad Vicky Oktafrian', '$2y$10$HztTRHBnyvK5sg696gng9udchHkjVgi5FOSeicf4RqBT/Gy2tMud.', 3, NULL),
('haloges85@gmail.com', 'Halo Surabaya', '$2y$10$hAE2I/iwNlLgIzmDKMjO8OTxJjyGmenKhTNVcbq7OTZ0J6cKjRQhq', 4, NULL),
('22081010028@student.upnjatim.ac.id', 'Arul', '$2y$10$ck5gEowwxp2kFNcVXcCEQ.Y4w9jGNScrX9n0cRJbfuCB2n.rYU/e2', 5, NULL),
('08', 'finescantik', '$2y$10$DJWXrRivQNHW3xsTNXEoA.gwefa5s6dAMgkVyogiV1.6RZ4BTnfPm', 6, NULL),
('ryanbagusbimantoro@gmail.com', 'Ryan', '$2y$10$ZfwkXduLTks.ps3H3pZnq.YBnWGiBiHV6vr/yMV4AiQdhUeGQRp5K', 7, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`,`password`,`username`);

--
-- Indeks untuk tabel `penalti`
--
ALTER TABLE `penalti`
  ADD PRIMARY KEY (`id_penalti`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `reservasi`
--
ALTER TABLE `reservasi`
  ADD PRIMARY KEY (`id_reservasi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_resevasi` (`id_resevasi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `reservasi`
--
ALTER TABLE `reservasi`
  MODIFY `id_reservasi` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `penalti`
--
ALTER TABLE `penalti`
  ADD CONSTRAINT `penalti_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_resevasi`) REFERENCES `reservasi` (`id_reservasi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
