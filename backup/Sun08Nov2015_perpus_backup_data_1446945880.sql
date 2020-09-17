DROP TABLE IF EXISTS anggota;

CREATE TABLE `anggota` (
  `no_agt` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(80) NOT NULL,
  `stts` varchar(10) NOT NULL,
  PRIMARY KEY (`no_agt`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO anggota VALUES("AGT0000001","Khairul Umam","Laki-Laki","Pekanbaru","1992-05-26","Jl. Tangkuban Perahu No 2\n","aktif");
INSERT INTO anggota VALUES("AGT0000002","Nicky William","Laki-Laki","Jakarta Selatan","1995-01-12","Jl Perahu","aktif");
INSERT INTO anggota VALUES("AGT0000003","Andi","Laki-Laki","Bangka","2013-02-22","Jl Soekarno Hatta","aktif");



DROP TABLE IF EXISTS bebas_pustaka;

CREATE TABLE `bebas_pustaka` (
  `no_bebas_pustaka` varchar(10) NOT NULL,
  `no_agt` varchar(10) NOT NULL,
  `tgl_bebas_pustaka` date NOT NULL,
  PRIMARY KEY (`no_bebas_pustaka`),
  KEY `no_agt` (`no_agt`)
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
  `lokasirak` varchar(30) NOT NULL,
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

INSERT INTO buku VALUES("2302309","23","23","23","Ilmu Pengetahuan Alam","Alex Nurdin Kona","Pengenalan Bentuk Tubuh Manusia","Lokasi Rak 1","1","1","1","1","Media Gema","Jakarta","2013","100","ada","ada","2302309","200","Pengadaan Buku 2014","20","2015-10-08");
INSERT INTO buku VALUES("2391392","2x1","23","ab","Sosial","Jojo Satuhi","Ilmu Pengetahuan Sosial","Rak 2","1","1","1","1","Media Gema","Jakarta","2011","180","Ada","Ada","2323232323","20","Pengadaan Buku 2014","20","2015-11-08");
INSERT INTO buku VALUES("34392391","2x3","av","2","Sosial","Yoyo Tatum","Pengenalan Ilmu Politik","Rak 3","1","1","1","1","Graha Modah","Jakarta","2014","100","Ada","Ada","3934983498","30","Pengadaan Buku 2014","20","2015-11-08");



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



DROP TABLE IF EXISTS pemesanan;

CREATE TABLE `pemesanan` (
  `no_pemesanan` int(10) NOT NULL AUTO_INCREMENT,
  `no_anggota` varchar(10) NOT NULL,
  `judul_buku` varchar(100) NOT NULL,
  `nama_pengarang` varchar(100) NOT NULL,
  PRIMARY KEY (`no_pemesanan`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS peminjaman;

CREATE TABLE `peminjaman` (
  `no_peminjaman` varchar(10) NOT NULL,
  `no_agt` varchar(10) NOT NULL,
  `kode_buku` varchar(20) NOT NULL,
  `buku` varchar(80) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`no_peminjaman`),
  KEY `no_agt` (`no_agt`),
  KEY `kode_buku` (`kode_buku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS pengembalian;

CREATE TABLE `pengembalian` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `no_peminjaman` varchar(10) NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `denda` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `no_peminjaman` (`no_peminjaman`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS tarif_denda;

CREATE TABLE `tarif_denda` (
  `id_tarif` varchar(11) NOT NULL,
  `tarif_denda` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tarif_denda VALUES("1","500");



