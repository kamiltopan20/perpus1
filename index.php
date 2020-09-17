<?php
session_start();
ob_start();
?>
<html>
<head>
<link href="style/style.css" rel="stylesheet" type="text/css"/>
<title>Perpustakaan SD IT An-Nahl Kota Jambi</title>
<link rel="stylesheet" type="text/css" href="javascript/autocomplete/jquery.autocomplete.css" />
<script type="text/javascript" src="javascript/autocomplete/jquery.js"></script>
<script type="text/javascript" src="javascript/autocomplete/jquery.autocomplete.js"></script>
<script type="text/javascript" src="plugin/Charts/jquery.fusioncharts.js" ></script>
<script language="javascript" src="modul/anggota/tampil.js"></script>
<script language="javascript" src="modul/peminjaman/ajax.js"></script>
<script language="javascript" src="modul/pencarian/caribuku.js"></script>
<script language="javascript" src="modul/pencarian/caripeminjaman.js"></script>
<script language="javascript" src="modul/pencarian/carianggota.js"></script>

 <script type="text/javascript">
        function numberFormat(nr)
        {
            //remove the existing
            var regex = /,/g;
            nr        = nr.replace(regex,'');

            //split it into 2 parts
            var x   = nr.split(',');
            var p1  = x[0];
            var p2  = x.length > 1 ? ',' + x[1] : '';
            //match group of 3 numbers (0-9) and add ',' between them
            regex   = /(\d+)(\d{3})/;
            while(regex.test(p1))
            {
                p1 = p1.replace(regex, '$1' + ',' + '$2');
            }
            //join the 2 parts and return the formatted number
            return p1 + p2;
        }
    </script>

<script>
 $(document).ready(function(){
  $("#no_anggota").autocomplete("modul/peminjaman/autocomplete.php", {
        selectFirst: true
  });
 });
</script>
<script>
 $(document).ready(function(){
  $("#kode_buku").autocomplete("modul/peminjaman/autocomplete2.php", {
        selectFirst: true
  });
 });
</script>
</head>
<body>
<center>
<table id="template" align="center"><tr>
<td id="header" style="background:url(images/header.jpg);width:100%;">

</td>
</tr>
<tr>
<td>
<div style="background:#d7cdea;font-size:16px;font-family:Times New Roman;margin-top:-3px;margin-bottom:-5px">
<marquee> <b>
    Selamat Datang Di E-Library SD IT An-Nahl Kota Jambi </b></marquee>
</div>
</td>

</tr>
<tr><td>
<?php
include "menu/menu.php";
?>
</td>

</table>

<div id="konten">
<?php
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tglsekarang = date("Y-m-d", $tanggal);
$pecah1 = explode("-", $tglsekarang);
$date1 = $pecah1[2];
$month1 = $pecah1[1];
$year1 = $pecah1[0];
$sekarang = GregorianToJD($month1, $date1, $year1);
$valid = "2100-01-11";
$pecah2 = explode("-", $valid);
$date2 = $pecah2[2];
$month2 = $pecah2[1];
$year2 = $pecah2[0];
$valid2 = GregorianToJD($month2, $date2, $year2);
$selisih = $valid2 - $sekarang;
if($selisih < 0)
{echo "--";
}
else{
include "koneksi/koneksi.php";
if (isset($_GET['modul'])) {
switch($_GET['modul']){
case "user";
include "modul/user/user.php";
break;
case "anggota";
include "modul/anggota/anggota.php";
break;
case "buku";
include "modul/buku/buku.php";
break;
case "tarif";
include "modul/tarif/tarif.php";
break;
case "peminjaman";
include "modul/peminjaman/peminjaman.php";
break;
case "pengembalian";
include "modul/pengembalian/pengembalian.php";
break;
case "bebaspustaka";
include "modul/bebaspustaka/bebaspustaka.php";
break;
case "lihatbebaspustaka";
include "modul/lihatbebaspustaka/lihatbebaspustaka.php";
break;
case "pencarian";
include "modul/pencarian/pencarian.php";
break;
case "laporanpinjam";
include "modul/laporanpinjam/laporanpinjam.php";
break;
case "laporanbebas";
include "modul/laporanbebas/laporanbebas.php";
break;
case "laporandenda";
include "modul/laporandenda/laporandenda.php";
break;
case "laporankartu";
include "modul/laporankartu/laporankartu.php";
break;
case "laporananggota";
include "modul/laporananggota/laporananggota.php";
break;
case "bigdump";
include "import/bigdump.php";
break;
case "validation";
include "login/aksilogin.php";
break;
case 'backup':
include 'modul/backup/backup.php';
break;
case 'pencariankhusus':
include 'modul/pencariankhusus/pencariankhusus.php';
break;
case 'pemesanan':
include 'modul/pemesanan/pemesanan.php';
break;
case "statistikpeminjaman";
include "modul/statistikpeminjaman/statistikpeminjaman.php";
break;
case 'restore':
include 'modul/backup/recovery_data.php';
break;
case 'profil':
include 'modul/profil.php';
break;
case 'ebook':
include 'modul/tabel_ebook.php';
break;
case 'te':
include 'modul/te.php';
break;
case 'anggotalogin':
include 'modul/anggota/login.php';
break;
case 'viewdata':
include 'modul/viewdata.php';
break;
case 'inputebook':
include 'modul/input_ebook.php';
break;
case 'prosesupload':
include 'modul/proses_upload.php';
break;
case 'ebookdel':
include 'modul/ebookdel.php';
break;
}
}else{
$result=mysql_query("select * from anggota");
if (empty($result)){
echo "Sistem Database Belum Di Install. </br><a href='index.php?modul=bigdump'>Install Sistem</a>";
}else{
if((!isset($_SESSION['userpus'])) && (!isset($_GET['login']))){
echo '<h3>Pencarian Data Buku</h3>
</br><form>
		<font face="verdana" size="2">Ketikkan Data Buku (Judul/Pengarang) Yang Ingin Di Cari : </font><input type="text" name="no_induk_buku" id="no_induk_buku" size="25" onkeyup="tampilbuku(no_induk_buku.value)" />
	<br />
	<div id="pencarianbuku"></div>';
	}
elseif ((isset($_GET['login'])) && (!isset($_SESSION['userpus']))){
echo '<center><div id="background" style="background-color:lightblue; width:350px; padding-top:15px; padding-bottom:15px;" >
<h4><div style="font-family:arial">Form Login Sistem</div></h4>
<img src="images/login.jpg" width="150"/>	
		<form action="?modul=validation&aksi=tampil" method="post">
			<table id="login" border="0">
			<tr><td>Username</td><td><input type="text" name="user"/></td></tr>
			<tr><td>Password</td><td><input type="password" name="password"/></td></tr>
			<tr><td colspan="2"><center><input type="submit" value="Login"/></center></td></tr>
			</table>
		</form></div></center>
	';
}
else
{
echo '</br></br><b>Selamat Datang Di Sistem Informasi Perpustakaan</b></br></br>';
echo 'Anda Login Sebagai <b>'.$_SESSION['userpus'].'</b></br></br> Anda dapat menggunakan fitur yang tersedia pada Sistem</br><a href="login/aksilogout.php">Logout</a></br>';
}
}
}
}
echo '</div></div><div id="footer">Copyright @2018 Lukman Sarip</div>
</center>
</body>
</html>';
?>