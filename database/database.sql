-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Nov 2023 pada 08.25
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_suteki`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `id_wph`
--

CREATE TABLE `id_wph` (
  `id_wph` int(11) NOT NULL,
  `id_user` varchar(200) NOT NULL,
  `tanggal` varchar(200) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `lokasi` varchar(200) NOT NULL,
  `jam_absen` varchar(200) NOT NULL,
  `nama_absen` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `id_wph`
--

INSERT INTO `id_wph` (`id_wph`, `id_user`, `tanggal`, `foto`, `lokasi`, `jam_absen`, `nama_absen`, `status`) VALUES
(22, '32', '2023-11-20', '1700456337_9e9e6cd8af5356bb6a79.jpeg', 'Latitude: -6.8845568 | Longitude: 107.56096', '11:58:57', 'absen_masuk', 'belum diverifikasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_absen`
--

CREATE TABLE `tb_absen` (
  `id_absen` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal` varchar(200) NOT NULL,
  `tanggal_time` varchar(200) NOT NULL,
  `absen_masuk` varchar(200) NOT NULL,
  `absen_siang` varchar(200) NOT NULL,
  `absen_pulang` varchar(200) NOT NULL,
  `jabsen` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_absen`
--

INSERT INTO `tb_absen` (`id_absen`, `id_user`, `tanggal`, `tanggal_time`, `absen_masuk`, `absen_siang`, `absen_pulang`, `jabsen`) VALUES
(40, 32, '2023-11-14', '1699926983', 'salah absen', '', '', 'WFO'),
(41, 32, '2023-11-16', '1700099901', 'salah absen', '', '', 'WFO'),
(42, 32, '2023-11-20', '1700456366', '11:58:57| WFH ❗', '11:59:26', '', 'WFH');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gol`
--

CREATE TABLE `tb_gol` (
  `id_gol` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_gol`
--

INSERT INTO `tb_gol` (`id_gol`, `nama`) VALUES
(12, 'Karyawan Tetap'),
(13, 'Kontrak'),
(14, 'Kerja Praktik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ipkantor`
--

CREATE TABLE `tb_ipkantor` (
  `id_list` int(11) NOT NULL,
  `ip_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_ipkantor`
--

INSERT INTO `tb_ipkantor` (`id_list`, `ip_name`) VALUES
(1, '192.168.10.1'),
(2, ''),
(3, ''),
(4, ''),
(5, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jabatan`
--

CREATE TABLE `tb_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jabatan`
--

INSERT INTO `tb_jabatan` (`id_jabatan`, `nama`) VALUES
(21, 'CEO'),
(24, 'Support Team'),
(25, 'Finance'),
(26, 'CTO'),
(27, 'VP of Backend Engineering'),
(28, 'VP of Frontend Engineering'),
(29, 'VP of Quality Assurance'),
(30, 'VP of Infrastructure'),
(31, 'Backend Engineer'),
(32, 'Frontend Engineer'),
(33, 'Quality Assurance'),
(34, 'Mobile Engineer'),
(35, 'Scrum Master'),
(36, 'PO'),
(37, 'KP'),
(39, 'Marketing'),
(40, 'Digital Marketing');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jamkerja`
--

CREATE TABLE `tb_jamkerja` (
  `id_jamkerja` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `jam1` varchar(200) NOT NULL,
  `jam2` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jamkerja`
--

INSERT INTO `tb_jamkerja` (`id_jamkerja`, `nama`, `jam1`, `jam2`) VALUES
(1, 'Jam Masuk', '07:30', '08:30'),
(2, 'Jam Siang', '10:20', '11:00'),
(3, 'Jam Pulang', '14:00', '23:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kerja`
--

CREATE TABLE `tb_kerja` (
  `id_kerja` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kerja`
--

INSERT INTO `tb_kerja` (`id_kerja`, `nama`, `status`) VALUES
(1, 'Senin', 'masuk'),
(2, 'Selasa', 'masuk'),
(3, 'Rabu', 'masuk'),
(4, 'Kamis', 'masuk'),
(5, 'Jumat', 'masuk'),
(6, 'Sabtu', 'libur'),
(7, 'Minggu', 'libur');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_libur`
--

CREATE TABLE `tb_libur` (
  `id_libur` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `waktu` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_libur`
--

INSERT INTO `tb_libur` (`id_libur`, `nama`, `waktu`) VALUES
(7, 'Tahun baru', '2023-01-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_notif`
--

CREATE TABLE `tb_notif` (
  `id_notif` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `waktu` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_notif`
--

INSERT INTO `tb_notif` (`id_notif`, `nama`, `waktu`, `status`) VALUES
(73, 'Vanissa Alya Berhasil Absensi WFO', '1699513058', '1'),
(74, 'ica Berhasil Absensi WFH', '1699513175', '1'),
(75, 'Alya Berhasil Absensi WFH', '1699518122', '1'),
(76, 'Vanissa Alya Berhasil Reset Password', '1699924379', '1'),
(77, 'Yushan Berhasil Absensi WFO', '1699926983', '1'),
(78, 'Yushan Berhasil Absensi WFO', '1700099901', '1'),
(79, 'Yushan Berhasil Absensi WFH', '1700456337', '1'),
(80, 'Yushan Berhasil Absensi WFO', '1700456366', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tidakhadir`
--

CREATE TABLE `tb_tidakhadir` (
  `id_tidakhadir` int(11) NOT NULL,
  `id_user` varchar(200) NOT NULL,
  `tanggal` varchar(200) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `ket` text NOT NULL,
  `alasan` text NOT NULL,
  `waktu_absen` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_users`
--

CREATE TABLE `tb_users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `golongan` varchar(255) NOT NULL,
  `grade` varchar(255) DEFAULT NULL,
  `cookie` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_users`
--

INSERT INTO `tb_users` (`id_user`, `nama`, `foto`, `email`, `password`, `nip`, `jabatan`, `golongan`, `grade`, `cookie`, `status`, `role`) VALUES
(26, 'ADMIN', '1699925765_deaf4368924a29c179a5.jpg', 'admin@gmail.com', 'admin', '1234567890', 'CEO', 'Karyawan Tetap', '-', 'cb7614c112db1eb4b3a9be73e51fc326', 'aktif', '2'),
(30, 'ica', 'default.jpg', 'ica@gmail.com', 'ica', '123456', 'QA/QC', 'Karyawan Tetap', '123', '14fff7214b11e434128bed5802ef734e', 'aktif', '1'),
(32, 'Yushan', 'default.jpg', 'yushan@gmail.com', 'yushan', '11223344', 'QA/QC', 'Kerja Praktik', '2023', '7bdd803b610b0f31c1e7f6fe07e184ad', 'aktif', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_website`
--

CREATE TABLE `tb_website` (
  `id_website` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `konfirmasi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_website`
--

INSERT INTO `tb_website` (`id_website`, `nama`, `konfirmasi`) VALUES
(1, 'ABSENSI SUTEKI TECHNOLOGY', 'konfirmasi');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `id_wph`
--
ALTER TABLE `id_wph`
  ADD PRIMARY KEY (`id_wph`);

--
-- Indeks untuk tabel `tb_absen`
--
ALTER TABLE `tb_absen`
  ADD PRIMARY KEY (`id_absen`);

--
-- Indeks untuk tabel `tb_gol`
--
ALTER TABLE `tb_gol`
  ADD PRIMARY KEY (`id_gol`);

--
-- Indeks untuk tabel `tb_ipkantor`
--
ALTER TABLE `tb_ipkantor`
  ADD PRIMARY KEY (`id_list`);

--
-- Indeks untuk tabel `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `tb_jamkerja`
--
ALTER TABLE `tb_jamkerja`
  ADD PRIMARY KEY (`id_jamkerja`);

--
-- Indeks untuk tabel `tb_kerja`
--
ALTER TABLE `tb_kerja`
  ADD PRIMARY KEY (`id_kerja`);

--
-- Indeks untuk tabel `tb_libur`
--
ALTER TABLE `tb_libur`
  ADD PRIMARY KEY (`id_libur`);

--
-- Indeks untuk tabel `tb_notif`
--
ALTER TABLE `tb_notif`
  ADD PRIMARY KEY (`id_notif`);

--
-- Indeks untuk tabel `tb_tidakhadir`
--
ALTER TABLE `tb_tidakhadir`
  ADD PRIMARY KEY (`id_tidakhadir`);

--
-- Indeks untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `tb_website`
--
ALTER TABLE `tb_website`
  ADD PRIMARY KEY (`id_website`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `id_wph`
--
ALTER TABLE `id_wph`
  MODIFY `id_wph` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `tb_absen`
--
ALTER TABLE `tb_absen`
  MODIFY `id_absen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `tb_gol`
--
ALTER TABLE `tb_gol`
  MODIFY `id_gol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_ipkantor`
--
ALTER TABLE `tb_ipkantor`
  MODIFY `id_list` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `tb_jamkerja`
--
ALTER TABLE `tb_jamkerja`
  MODIFY `id_jamkerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_kerja`
--
ALTER TABLE `tb_kerja`
  MODIFY `id_kerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_libur`
--
ALTER TABLE `tb_libur`
  MODIFY `id_libur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_notif`
--
ALTER TABLE `tb_notif`
  MODIFY `id_notif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT untuk tabel `tb_tidakhadir`
--
ALTER TABLE `tb_tidakhadir`
  MODIFY `id_tidakhadir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `tb_website`
--
ALTER TABLE `tb_website`
  MODIFY `id_website` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
