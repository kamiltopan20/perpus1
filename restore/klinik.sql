-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Waktu pembuatan: 02. September 2013 jam 14:12
-- Versi Server: 5.1.37
-- Versi PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `klinik`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `counter`
--

CREATE TABLE IF NOT EXISTS `counter` (
  `ip` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `hits` int(10) NOT NULL,
  `online` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `counter`
--

INSERT INTO `counter` (`ip`, `tanggal`, `hits`, `online`) VALUES
('::1', '2013-09-02', 79, '1378102318');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `user` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `level` varchar(20) NOT NULL,
  `alamat` varchar(80) NOT NULL,
  `kota` varchar(20) NOT NULL,
  `kode_pos` varchar(20) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `tempat_lahir` varchar(40) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`user`, `password`, `nama`, `level`, `alamat`, `kota`, `kode_pos`, `no_telp`, `tempat_lahir`, `tanggal_lahir`) VALUES
('admin', 'admin', 'Administrator', 'admin', 'Jl Surabaya', 'Tembilahan', '23283', '085736573645', 'Tembilahan', '1992-05-26'),
('hijab', 'tole', '', 'admin', '', '', '', '', '', '1992-06-25'),
('reno', 'reno', 'Reno Sukardi', 'admin', '', '', '', '', '', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_logo_klinik`
--

CREATE TABLE IF NOT EXISTS `tbl_logo_klinik` (
  `id_logo` varchar(10) NOT NULL,
  `logo` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_logo_klinik`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_obat`
--

CREATE TABLE IF NOT EXISTS `tbl_obat` (
  `id_obat` varchar(10) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `jenis_obat` varchar(50) NOT NULL,
  PRIMARY KEY (`id_obat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_obat`
--

INSERT INTO `tbl_obat` (`id_obat`, `nama_obat`, `jenis_obat`) VALUES
('OBT0000004', 'kjhk', 'Kapsul'),
('OBT0000005', 'yuyuyuy', 'Kapsul'),
('OBT0000006', 'jhkh', 'Kapsul'),
('OBT0000007', 'jhkh', 'Kapsul'),
('OBT0000008', 'iu', 'Kapsul'),
('OBT0000009', 'ljlkj', 'Kapsul'),
('OBT0000010', 'Paracetamol', 'Tablet');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pasien`
--

CREATE TABLE IF NOT EXISTS `tbl_pasien` (
  `id_pasien` varchar(10) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `pekerjaan` varchar(45) NOT NULL,
  `namakk` varchar(40) NOT NULL,
  `berat` varchar(3) NOT NULL,
  `tinggi` varchar(3) NOT NULL,
  `tanggal_daftar` date NOT NULL,
  `tel` varchar(20) NOT NULL,
  PRIMARY KEY (`id_pasien`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pasien`
--

INSERT INTO `tbl_pasien` (`id_pasien`, `nama`, `tanggal_lahir`, `alamat`, `jenis_kelamin`, `pekerjaan`, `namakk`, `berat`, `tinggi`, `tanggal_daftar`, `tel`) VALUES
('PSN0000001', 'Khairul Umam', '1992-05-26', '										Jl H Arief Gg Harapan Baru No 598', 'Laki-Laki', 'Mahasiswa', 'Mukrin', '1', '1', '2013-08-27', '085213613445'),
('PSN0000002', 'Markonah', '2000-06-13', '					Jl Subrantas', 'Perempuan', 'Mahasiswa', 'Andi', '1', '1', '2013-08-27', '08457348234');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pasien_val`
--

CREATE TABLE IF NOT EXISTS `tbl_pasien_val` (
  `id_pasien` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pasien_val`
--


-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_riwayat`
--

CREATE TABLE IF NOT EXISTS `tbl_riwayat` (
  `id_pasien` varchar(10) NOT NULL,
  `id_riwayat` varchar(10) NOT NULL,
  `riwayat` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_riwayat`
--

INSERT INTO `tbl_riwayat` (`id_pasien`, `id_riwayat`, `riwayat`, `keterangan`) VALUES
('PSN0000001', 'RWT0000001', 'test', 'test'),
('PSN0000001', 'RWT0000002', 'test 2', 'test 2'),
('PSN0000001', 'RWT0000003', 'test 3', 'test 3'),
('PSN0000001', 'RWT0000004', 'test 4', 'test 4'),
('PSN0000002', 'RWT0000005', 'tes', 'tes'),
('PSN0000002', 'RWT0000006', 'tes 1', 'tes 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `idusr` int(11) NOT NULL,
  `user` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`idusr`, `user`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'gien', '21232f297a57a5a743894a0e4a801fc3');
