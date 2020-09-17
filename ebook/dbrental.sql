-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 18, 2012 at 09:00 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbrental`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE IF NOT EXISTS `anggota` (
  `no_anggota` varchar(5) NOT NULL DEFAULT '',
  `nama_anggota` varchar(50) NOT NULL DEFAULT '',
  `alamat` varchar(50) NOT NULL DEFAULT '',
  `jenis_kelamin` varchar(12) NOT NULL DEFAULT '',
  `tanggal_lahir` date NOT NULL DEFAULT '0000-00-00',
  `no_telp` varchar(12) NOT NULL DEFAULT '',
  PRIMARY KEY (`no_anggota`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`no_anggota`, `nama_anggota`, `alamat`, `jenis_kelamin`, `tanggal_lahir`, `no_telp`) VALUES
('A001', 'Asyifa Febri Callista', 'Jl. Ujung Tanah No.14 Lubeg', 'PEREMPUAN', '1990-11-17', '081374557800'),
('A002', 'Nana Mardiana', 'Jl. Aur Duri', 'Perempuan', '1990-10-15', '081374557800'),
('A003', 'Edra Nofandri', 'jl. Lubuk Begalung', 'Laki-Laki', '1991-12-12', '081374557800');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE IF NOT EXISTS `buku` (
  `kode_buku` varchar(5) NOT NULL DEFAULT '',
  `judul` varchar(50) NOT NULL DEFAULT '',
  `pengarang` varchar(50) NOT NULL DEFAULT '',
  `penerbit` varchar(50) NOT NULL DEFAULT '',
  `kategori` varchar(50) NOT NULL DEFAULT '',
  `thn_terbit` int(10) DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL,
  `rak` int(10) DEFAULT NULL,
  `kode_suplier` varchar(5) NOT NULL DEFAULT '',
  PRIMARY KEY (`kode_buku`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`kode_buku`, `judul`, `pengarang`, `penerbit`, `kategori`, `thn_terbit`, `jumlah`, `rak`, `kode_suplier`) VALUES
('B001', 'Mudah Membangun Server dengan ClearOS', 'Iwan Sofana', 'Informatika', 'Pemprograman', 2007, 5, 1, 'S001'),
('B002', 'Cara Mudah Membuat CMS', 'Teguh Wahyono', 'PT.Elex Media Komputindo', 'Komputer', 2009, 3, 2, 'S003'),
('B003', 'Belajar Membuat Web Server', 'Andi Syofyan', 'Glasico', 'Komputer', 2011, 10, 1, 'S001'),
('B004', 'Fedora Core', 'Iwan Sofana', 'Elexmedia', 'Komputer', 2008, 4, 5, 'S005'),
('B005', 'Tuntunan Praktis Membangun SIA', 'Kusrini', 'ANDI', 'Komputer', 2007, 7, 2, 'S003');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE IF NOT EXISTS `peminjaman` (
  `kode_pinjam` varchar(5) NOT NULL DEFAULT '',
  `no_anggota` varchar(5) NOT NULL DEFAULT '',
  `kode_buku` varchar(5) NOT NULL DEFAULT '',
  `tgl_pinjam` date NOT NULL DEFAULT '0000-00-00',
  `tgl_hrs_kembali` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`kode_pinjam`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`kode_pinjam`, `no_anggota`, `kode_buku`, `tgl_pinjam`, `tgl_hrs_kembali`) VALUES
('P001', 'A001', 'B001', '2011-10-02', '2011-10-05'),
('P002', 'A004', 'B001', '2011-10-11', '2011-10-14'),
('P003', 'A003', 'B004', '2011-10-21', '2011-10-24'),
('P004', 'A005', 'B003', '2011-10-25', '2011-10-28'),
('P005', 'A002', 'B005', '2011-10-26', '2011-10-29');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE IF NOT EXISTS `pengembalian` (
  `kode_kembali` varchar(5) NOT NULL DEFAULT '',
  `kode_pinjam` varchar(5) NOT NULL DEFAULT '',
  `tgl_kembali` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`kode_pinjam`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`kode_kembali`, `kode_pinjam`, `tgl_kembali`) VALUES
('K001', 'P001', '2011-10-10'),
('K002', 'P003', '2011-10-29'),
('K003', 'P004', '2011-10-30'),
('K004', 'P005', '2011-10-31'),
('K005', 'P002', '2011-10-17');

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE IF NOT EXISTS `suplier` (
  `kode_suplier` varchar(5) NOT NULL DEFAULT '',
  `nama_suplier` varchar(50) NOT NULL DEFAULT '',
  `perusahaan` varchar(35) NOT NULL DEFAULT '',
  `alamat` varchar(50) NOT NULL DEFAULT '',
  `no_telp` varchar(12) NOT NULL DEFAULT '',
  PRIMARY KEY (`kode_suplier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`kode_suplier`, `nama_suplier`, `perusahaan`, `alamat`, `no_telp`) VALUES
('S001', 'ANDI SYOFYAN', 'PT.Jaya Abadi', 'Jl. Pemuda', '081234567479'),
('S002', 'CHAIRUL HADI', 'PT.sENTOSA', 'Jl. Simpang Haru', '085643986753'),
('S003', 'BUDI SANTOSO', 'PT.Perkasa Jaya', 'jl. ambacang', '087895643675'),
('S004', 'ANDI KURNIAWAN', 'PT.ANDI PUBLISER', 'jl. kemenangan', '089364562884'),
('S005', 'JOKO PUSPITO', 'PT.GRAMEDIA', 'Jl. Lubuk Begalung', '084526458975');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
