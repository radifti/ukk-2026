-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2026 at 02:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_aspirasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(12347, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `aspirasi`
--

CREATE TABLE `aspirasi` (
  `id_aspirasi` int(5) NOT NULL,
  `status` enum('menunggu','proses','selesai') NOT NULL DEFAULT 'menunggu',
  `id_pelaporan` int(5) NOT NULL,
  `feedback` varchar(100) NOT NULL,
  `tanggal_input` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aspirasi`
--

INSERT INTO `aspirasi` (`id_aspirasi`, `status`, `id_pelaporan`, `feedback`, `tanggal_input`) VALUES
(1, 'selesai', 1, 'Lampu sudah diganti oleh tim sarpras', '2026-03-05'),
(2, 'proses', 2, 'Sedang dicek oleh teknisi lab', '2026-03-06'),
(3, 'menunggu', 3, 'Akan didiskusikan dengan pengelola kantin', '2026-03-07'),
(4, 'selesai', 4, 'Kran sudah diperbaiki', '2026-03-08'),
(5, 'proses', 5, 'Pengadaan lensa proyektor baru', '2026-03-09'),
(6, 'selesai', 11, 'Obat-obatan sudah distok kembali di UKS', '2026-03-15'),
(7, 'proses', 12, 'Router sedang dalam tahap reset berkala', '2026-03-16'),
(8, 'selesai', 13, 'Selokan sudah dibersihkan petugas', '2026-03-17'),
(9, 'menunggu', 19, 'Laporan diterima, sedang pesan unit baru', '2026-03-21'),
(10, 'selesai', 20, 'Senar gitar sudah diganti baru', '2026-03-22');

-- --------------------------------------------------------

--
-- Table structure for table `input_aspirasi`
--

CREATE TABLE `input_aspirasi` (
  `id_pelaporan` int(5) NOT NULL,
  `nis` int(10) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `ket` varchar(50) NOT NULL,
  `tanggal_input` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `input_aspirasi`
--

INSERT INTO `input_aspirasi` (`id_pelaporan`, `nis`, `id_kategori`, `lokasi`, `ket`, `tanggal_input`) VALUES
(1, 1001, 1, 'Parkiran', 'Lampu parkir mati saat sore hari', '2026-03-01'),
(2, 1005, 5, 'Lab RPL', 'PC Nomor 12 sering blue screen', '2026-03-02'),
(3, 1009, 9, 'Kantin', 'Harga air mineral terlalu mahal', '2026-03-03'),
(4, 1002, 2, 'Toilet Lt 2', 'Kran air bocor dan air terbuang', '2026-03-04'),
(5, 1006, 4, 'Ruang Kelas', 'Proyektor di kelas XI TKJ 1 buram', '2026-03-05'),
(6, 1010, 8, 'Perpustakaan', 'Buku referensi PHP terbaru kurang', '2026-03-06'),
(7, 1003, 3, 'Gerbang', 'Satpam tidak ada saat jam pulang', '2026-03-07'),
(8, 1007, 7, 'Ruang BK', 'Butuh sesi sharing kesehatan mental', '2026-03-08'),
(9, 1011, 1, 'Mushola', 'Sajadah sudah bau dan berdebu', '2026-03-09'),
(10, 1004, 10, 'Lapangan', 'Bola basket sudah gundul/rusak', '2026-03-10'),
(11, 1008, 6, 'UKS', 'Stok obat merah dan perban habis', '2026-03-11'),
(12, 1012, 5, 'Server Room', 'Koneksi Wi-Fi sering RTO', '2026-03-12'),
(13, 1013, 2, 'Taman', 'Banyak sampah plastik di selokan', '2026-03-13'),
(14, 1017, 1, 'Koridor', 'Lantai licin setelah hujan', '2026-03-14'),
(15, 1014, 4, 'Lab TKJ', 'Kabel LAN banyak yang putus', '2026-03-15'),
(16, 1018, 9, 'Kantin', 'Antrean makan siang terlalu lama', '2026-03-16'),
(17, 1015, 3, 'Area Belakang', 'Pagar sekolah ada yang bolong', '2026-03-17'),
(18, 1019, 8, 'Perpustakaan', 'AC perpustakaan kurang dingin', '2026-03-18'),
(19, 1016, 2, 'Kelas MM', 'Tempat sampah pecah', '2026-03-19'),
(20, 1020, 10, 'Ruang Musik', 'Gitar butuh ganti senar', '2026-03-20');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `ket_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `ket_kategori`) VALUES
(1, 'Fasilitas Umum'),
(2, 'Kebersihan Lingkungan'),
(3, 'Keamanan Sekolah'),
(4, 'Kualitas Pembelajaran'),
(5, 'Sarana Teknologi'),
(6, 'Layanan Kesehatan'),
(7, 'Bimbingan Konseling'),
(8, 'Perpustakaan'),
(9, 'Kantin Sekolah'),
(10, 'Ekstrakurikuler');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` int(10) NOT NULL,
  `kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `kelas`) VALUES
(1001, 'X RPL 1'),
(1002, 'X TKJ 2'),
(1003, 'X TJA 1'),
(1004, 'X MM 3'),
(1005, 'XI RPL 2'),
(1006, 'XI TKJ 1'),
(1007, 'XI TJA 3'),
(1008, 'XI MM 2'),
(1009, 'XII RPL 1'),
(1010, 'XII TKJ 3'),
(1011, 'XII TJA 2'),
(1012, 'XII MM 1'),
(1013, 'X RPL 3'),
(1014, 'XI TKJ 2'),
(1015, 'XII TJA 1'),
(1016, 'X MM 2'),
(1017, 'XI RPL 1'),
(1018, 'XII TKJ 2'),
(1019, 'X TJA 3'),
(1020, 'XI MM 3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD PRIMARY KEY (`id_aspirasi`),
  ADD KEY `id_pelaporan` (`id_pelaporan`);

--
-- Indexes for table `input_aspirasi`
--
ALTER TABLE `input_aspirasi`
  ADD PRIMARY KEY (`id_pelaporan`),
  ADD KEY `nis` (`nis`,`id_kategori`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12348;

--
-- AUTO_INCREMENT for table `aspirasi`
--
ALTER TABLE `aspirasi`
  MODIFY `id_aspirasi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `input_aspirasi`
--
ALTER TABLE `input_aspirasi`
  MODIFY `id_pelaporan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `nis` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1021;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD CONSTRAINT `aspirasi_ibfk_1` FOREIGN KEY (`id_pelaporan`) REFERENCES `input_aspirasi` (`id_pelaporan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `input_aspirasi`
--
ALTER TABLE `input_aspirasi`
  ADD CONSTRAINT `input_aspirasi_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `input_aspirasi_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
