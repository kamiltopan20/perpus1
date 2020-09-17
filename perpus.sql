-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2020 at 07:34 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `no_agt` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(80) NOT NULL,
  `stts` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`no_agt`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `stts`) VALUES
('AGT0000001', 'Khairul Umam', 'Laki-Laki', 'Pekanbaru', '1992-05-26', 'Jl. Tangkuban Perahu No 2\r\n', 'aktif'),
('AGT0000002', 'Nicky William', 'Laki-Laki', 'Jakarta Selatan', '1995-01-12', 'Jl Perahu', 'aktif'),
('AGT0000003', 'Andi', 'Laki-Laki', 'Bangka', '2013-02-22', 'Jl Soekarno Hatta', 'aktif'),
('AGT0000004', 'rizkyy', 'Laki-Laki', 'cupak', '2003-06-12', 'tangah padang', 'aktif'),
('AGT0000005', 'giffrai', 'Laki-Laki', 'solok', '2002-06-05', 'solok', 'aktif'),
('AGT0000006', 'dadsa', 'Laki-Laki', 'dadad', '0000-00-00', 'dadada', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `bebas_pustaka`
--

CREATE TABLE `bebas_pustaka` (
  `no_bebas_pustaka` varchar(10) NOT NULL,
  `no_agt` varchar(10) NOT NULL,
  `tgl_bebas_pustaka` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `no_induk_buku` varchar(20) NOT NULL,
  `pengarang` varchar(60) NOT NULL,
  `judul` varchar(80) NOT NULL,
  `lokasirak` varchar(30) NOT NULL,
  `penerbit` varchar(20) NOT NULL,
  `kota_terbit` varchar(20) NOT NULL,
  `tahun_terbit` varchar(4) NOT NULL,
  `ISBN` varchar(40) NOT NULL,
  `jumlah_eksemplar` varchar(20) NOT NULL,
  `selesai_diproses` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`no_induk_buku`, `pengarang`, `judul`, `lokasirak`, `penerbit`, `kota_terbit`, `tahun_terbit`, `ISBN`, `jumlah_eksemplar`, `selesai_diproses`) VALUES
('123', 'hjh', 'hj', 'hj', 'hj', 'hj', 'hj', '787', '10', '2016-06-08'),
('124', 'Burhanudin Putra', 'Biologi 7A', 'A4', 'Erlangga', 'Jakarta', '2015', '25', '10', '2016-06-06'),
('125', 'Andi Kusuma', 'Belajar B.Indonesia', 'A4', 'Yudhistira', 'Bandung', '2014', 'B002', '14', '2016-06-06'),
('126', 'rafiqi', 'matematika', 'a4', 'rafiqi', 'padang', '2015', '0909', '3', '2015-06-03'),
('127', 'ilham', 'pendidikan kewarganegaraan', 'a5', 'erlangga', 'jakarta', '2015', '09099', '10', '2015-06-11'),
('128', 'habib', 'agama', 'a6', 'yudistira', 'jakarta', '2014', '090900', '10', '2015-06-17'),
('129', 'corry', 'geografi', 'a4', 'erlangga', 'jakarta', '2015', '111111', '11', '2015-06-01'),
('130', 'yudistira', 'fisika', 'a6', 'erlangga', 'bandung', '2015', '222', '8', '2015-11-11');

-- --------------------------------------------------------

--
-- Table structure for table `ebook`
--

CREATE TABLE `ebook` (
  `id` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `pengarang` varchar(50) DEFAULT NULL,
  `link` varchar(50) NOT NULL,
  `kode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ebook`
--

INSERT INTO `ebook` (`id`, `judul`, `pengarang`, `link`, `kode`) VALUES
(1, 'Akuntansi', NULL, 'Akutansi.pdf', '1'),
(2, 'Komputer', NULL, 'Pengantar TI.pdf', '1'),
(3, 'Bahasa Indonesia', NULL, 'Bahasa_Indonesia.pdf', '2'),
(4, 'Bahasa Inggris', NULL, 'Bahasa_Inggris.pdf', '2'),
(5, 'Pendidikan Agama Islam', NULL, 'Pendidikan_Agama_Islam.pdf', '1'),
(8, 'jj', NULL, '3253-8153-1-SM.pdf', '2');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `level` varchar(20) NOT NULL,
  `alamat` varchar(80) NOT NULL,
  `kota` varchar(20) NOT NULL,
  `kode_pos` varchar(20) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `tempat_lahir` varchar(40) NOT NULL,
  `tanggal_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user`, `password`, `nama`, `level`, `alamat`, `kota`, `kode_pos`, `no_telp`, `tempat_lahir`, `tanggal_lahir`) VALUES
('admin', 'afb91ef692fd08c445e8cb1bab2ccf9c', 'Eko Kusumo', 'Ketua', 'Jl Soekarno Hatta', 'Jakarta', '23283', '085777777777', 'Jakarta', '1992-05-25'),
('AGT0000001', '827ccb0eea8a706c4c34a16891f84e7b', 'wkakak', 'Member', 'wkkkwkk', 'kwkwk', '02929', '088', 'wkwk', '2017-06-14'),
('AGT0000002', 'e10adc3949ba59abbe56e057f20f883e', 'det', 'Member', 'padang', 'padang', '2222', '11', '111', '0000-00-00'),
('petugas', 'afb91ef692fd08c445e8cb1bab2ccf9c', 'rafiqi', 'Pustakawan', 'padang', 'solok', '27361', '082283190157', 'cupak', '1995-07-02');

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `no_pemesanan` int(10) NOT NULL,
  `no_anggota` varchar(10) NOT NULL,
  `judul_buku` varchar(100) NOT NULL,
  `nama_pengarang` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`no_pemesanan`, `no_anggota`, `judul_buku`, `nama_pengarang`) VALUES
(2, 'AGT0000002', 'Kimia', 'Hetti Iskandar'),
(3, 'AGT0000002', 'matematika', 'rafiqi'),
(4, 'AGT0000001', 'pendidikan kewarganegaraan', 'ilham'),
(5, 'AGT0000001', 'pendidikan kewarganegaraan', 'erlangga'),
(6, 'AGT0000001', 'biologi', 'erlangga'),
(7, 'AGT0000004', 'matematika', 'rafiqi'),
(8, 'AGT0000002', 'matematika', 'rafiqi'),
(9, 'AGT0000001', 'matematika', 'rafiqi'),
(10, 'AGT0000001', 'matematika', 'rafiqi'),
(11, 'AGT0000001', 'matematika', 'rafiqi'),
(12, 'AGT0000003', 'matematika', 'rafiqi'),
(13, 'AGT0000005', 'matematika', 'rafiqi'),
(14, 'AGT0000004', 'matematika', 'rafiqi');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `no_peminjaman` varchar(10) NOT NULL,
  `no_agt` varchar(10) NOT NULL,
  `kode_buku` varchar(20) NOT NULL,
  `buku` varchar(80) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`no_peminjaman`, `no_agt`, `kode_buku`, `buku`, `tgl_pinjam`, `tgl_kembali`, `status`) VALUES
('PM00000001', 'AGT0000001', '124', 'Biologi', '2016-06-06', '2016-06-13', 'dikembalikan'),
('PM00000002', 'AGT0000002', '124', 'Biologi', '2016-06-06', '2016-06-13', 'dikembalikan'),
('PM00000003', 'AGT0000003', '125 ', 'Belajar B.Indonesia', '2016-06-04', '2016-06-11', 'dipinjam'),
('PM00000004', 'AGT0000002', '126', 'matematika', '2017-06-08', '2017-06-15', 'dikembalikan'),
('PM00000006', 'AGT0000001', '127', 'pendidikan kewarganegaraan', '2017-06-08', '2017-06-15', 'dikembalikan'),
('PM00000007', 'AGT0000004', '126', 'matematika', '2017-06-09', '2017-06-16', 'dikembalikan'),
('PM00000008', 'AGT0000002', '126', 'matematika', '2017-06-12', '2017-06-19', 'dipinjam'),
('PM00000009', 'AGT0000001', '125', 'Belajar B.Indonesia', '2017-06-17', '2017-06-24', 'dikembalikan'),
('PM00000010', 'AGT0000003', '126', 'matematika', '2017-06-18', '2017-06-25', 'dipinjam'),
('PM00000011', 'AGT0000005', '126', 'matematika', '2017-06-18', '2017-06-25', 'dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id` int(20) NOT NULL,
  `no_peminjaman` varchar(10) NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `denda` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id`, `no_peminjaman`, `tgl_pengembalian`, `denda`) VALUES
(1, 'PM00000001', '2016-06-06', 0),
(2, 'PM00000004', '2017-06-08', 0),
(3, 'PM00000006', '2017-06-08', 0),
(4, 'PM00000002', '2017-06-09', 1805000),
(5, 'PM00000007', '2017-06-09', 0),
(6, 'PM00000009', '2017-06-17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tarif_denda`
--

CREATE TABLE `tarif_denda` (
  `id_tarif` varchar(11) NOT NULL,
  `tarif_denda` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tarif_denda`
--

INSERT INTO `tarif_denda` (`id_tarif`, `tarif_denda`) VALUES
('1', 5000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`no_agt`);

--
-- Indexes for table `bebas_pustaka`
--
ALTER TABLE `bebas_pustaka`
  ADD PRIMARY KEY (`no_bebas_pustaka`),
  ADD KEY `no_agt` (`no_agt`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`no_induk_buku`);

--
-- Indexes for table `ebook`
--
ALTER TABLE `ebook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`no_pemesanan`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`no_peminjaman`),
  ADD KEY `no_agt` (`no_agt`),
  ADD KEY `kode_buku` (`kode_buku`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_peminjaman` (`no_peminjaman`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ebook`
--
ALTER TABLE `ebook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `no_pemesanan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
