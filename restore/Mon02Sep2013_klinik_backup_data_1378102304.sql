DROP TABLE IF EXISTS counter;

CREATE TABLE `counter` (
  `ip` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `hits` int(10) NOT NULL,
  `online` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO counter VALUES("::1","2013-09-02","78","1378102304");



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

INSERT INTO login VALUES("admin","admin","Administrator","admin","Jl Surabaya","Tembilahan","23283","085736573645","Tembilahan","1992-05-26");
INSERT INTO login VALUES("hijab","tole","","admin","","","","","","1992-06-25");
INSERT INTO login VALUES("reno","reno","Reno Sukardi","admin","","","","","","0000-00-00");



DROP TABLE IF EXISTS tbl_logo_klinik;

CREATE TABLE `tbl_logo_klinik` (
  `id_logo` varchar(10) NOT NULL,
  `logo` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS tbl_obat;

CREATE TABLE `tbl_obat` (
  `id_obat` varchar(10) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `jenis_obat` varchar(50) NOT NULL,
  PRIMARY KEY (`id_obat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_obat VALUES("OBT0000004","kjhk","Kapsul");
INSERT INTO tbl_obat VALUES("OBT0000005","yuyuyuy","Kapsul");
INSERT INTO tbl_obat VALUES("OBT0000006","jhkh","Kapsul");
INSERT INTO tbl_obat VALUES("OBT0000007","jhkh","Kapsul");
INSERT INTO tbl_obat VALUES("OBT0000008","iu","Kapsul");
INSERT INTO tbl_obat VALUES("OBT0000009","ljlkj","Kapsul");
INSERT INTO tbl_obat VALUES("OBT0000010","Paracetamol","Tablet");



DROP TABLE IF EXISTS tbl_pasien;

CREATE TABLE `tbl_pasien` (
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

INSERT INTO tbl_pasien VALUES("PSN0000001","Khairul Umam","1992-05-26","										Jl H Arief Gg Harapan Baru No 598","Laki-Laki","Mahasiswa","Mukrin","1","1","2013-08-27","085213613445");
INSERT INTO tbl_pasien VALUES("PSN0000002","Markonah","2000-06-13","					Jl Subrantas","Perempuan","Mahasiswa","Andi","1","1","2013-08-27","08457348234");



DROP TABLE IF EXISTS tbl_pasien_val;

CREATE TABLE `tbl_pasien_val` (
  `id_pasien` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS tbl_riwayat;

CREATE TABLE `tbl_riwayat` (
  `id_pasien` varchar(10) NOT NULL,
  `id_riwayat` varchar(10) NOT NULL,
  `riwayat` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_riwayat VALUES("PSN0000001","RWT0000001","test","test");
INSERT INTO tbl_riwayat VALUES("PSN0000001","RWT0000002","test 2","test 2");
INSERT INTO tbl_riwayat VALUES("PSN0000001","RWT0000003","test 3","test 3");
INSERT INTO tbl_riwayat VALUES("PSN0000001","RWT0000004","test 4","test 4");
INSERT INTO tbl_riwayat VALUES("PSN0000002","RWT0000005","tes","tes");
INSERT INTO tbl_riwayat VALUES("PSN0000002","RWT0000006","tes 1","tes 1");



DROP TABLE IF EXISTS tbl_user;

CREATE TABLE `tbl_user` (
  `idusr` int(11) NOT NULL,
  `user` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_user VALUES("1","admin","21232f297a57a5a743894a0e4a801fc3");
INSERT INTO tbl_user VALUES("2","gien","21232f297a57a5a743894a0e4a801fc3");



