DROP TABLE IF EXISTS anggota;

CREATE TABLE `anggota` (
  `no_agt` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(80) NOT NULL,
  `stts` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO anggota VALUES("AGT0000001","Khairul Umam","Laki-Laki","Pekanbaru","1992-05-26","Jl. Tangkuban Perahu No 2\n","aktif");
INSERT INTO anggota VALUES("AGT0000002","Nicky William","Laki-Laki","Jakarta Selatan","1995-01-12","Jl Perahu","aktif");
INSERT INTO anggota VALUES("AGT0000003","Andi","Laki-Laki","Bangka","2013-02-22","Jl Soekarno Hatta","aktif");



DROP TABLE IF EXISTS bebas_pustaka;

CREATE TABLE `bebas_pustaka` (
  `no_bebas_pustaka` varchar(10) NOT NULL,
  `no_agt` varchar(10) NOT NULL,
  `tgl_bebas_pustaka` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS buku;

CREATE TABLE `buku` (
  `no_induk_buku` varchar(20) NOT NULL,
  `call_number_1` varchar(10) NOT NULL,
  `call_number_2` varchar(10) NOT NULL,
  `call_number_3` varchar(10) NOT NULL,
  `tajuk_subjek` varchar(30) NOT NULL,
  `pengarang` varchar(60) NOT NULL,
  `judul` varchar(80) NOT NULL,
  `jilid_ke` varchar(10) NOT NULL,
  `seri` varchar(10) NOT NULL,
  `edisi_ke` varchar(10) NOT NULL,
  `cetakan_ke` varchar(10) NOT NULL,
  `penerbit` varchar(20) NOT NULL,
  `kota_terbit` varchar(20) NOT NULL,
  `tahun_terbit` varchar(4) NOT NULL,
  `jumlah_halaman` varchar(10) NOT NULL,
  `ilustrasi` varchar(10) NOT NULL,
  `bibliografi` varchar(10) NOT NULL,
  `ISBN` varchar(40) NOT NULL,
  `tinggi_buku` varchar(10) NOT NULL,
  `diterima_dari` varchar(80) NOT NULL,
  `jumlah_eksemplar` varchar(10) NOT NULL,
  `selesai_diproses` date NOT NULL,
  PRIMARY KEY (`no_induk_buku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO buku VALUES("12134323","","","","dredfkj","sfdkj","dsfkj","1","1","1","1","wdsd","sdkj","2001","201","Ada","ada","34983","230","sdkjsdkj","2","2014-11-02");



DROP TABLE IF EXISTS login;

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
  `tanggal_lahir` date NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO login VALUES("admin","96e79218965eb72c92a549dd5a330112","Eko Kusumo","Ketua","Jl Soekarno Hatta","Jakarta","23283","085777777777","Jakarta","1992-05-25");
INSERT INTO login VALUES("petugas","96e79218965eb72c92a549dd5a330112","Rina Andini","Pustakawan","Jl Manggis","Jakarta Pusat","28291","085400000000","Surabaya","1975-11-11");



DROP TABLE IF EXISTS peminjaman;

CREATE TABLE `peminjaman` (
  `no_peminjaman` varchar(10) NOT NULL,
  `no_agt` varchar(10) NOT NULL,
  `kode_buku` varchar(20) NOT NULL,
  `buku` varchar(80) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS pengembalian;

CREATE TABLE `pengembalian` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `no_peminjaman` varchar(10) NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `denda` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS tarif_denda;

CREATE TABLE `tarif_denda` (
  `id_tarif` varchar(11) NOT NULL,
  `tarif_denda` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tarif_denda VALUES("1","500");



