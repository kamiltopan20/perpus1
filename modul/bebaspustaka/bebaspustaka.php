<?php
if((!isset($_SESSION['userpus'])) || ($_SESSION['levelpus']!="Ketua")) {
header("Location: index.php");
}else{
switch ($_GET['aksi'])
{

case "tampil";
echo '<h3>Bebas Pustaka</h3>';
echo '<center>- Bebas Pustaka Digunakan Untuk Menonaktifkan Anggota
</br>- Setelah itu anggota tidak bisa lagi meminjam buku</br>
<b><span style="color:red">- Setelah Tombol "Bebaskan" Ditekan, Maka Anggota Bersangkutan Tidak Dapat Diaktifkan Lagi</span></b></br></br><form action="?modul=bebaspustaka&aksi=tampil&cari=tampildata" method="POST">Masukkan No Anggota :<input type="text" name="no_anggota"/></form></br></br><a href="index.php?modul=lihatbebaspustaka&aksi=tampil">Lihat Data Bebas Pustaka</a></center>';
if(isset($_GET['cari'])){
switch ($_GET['cari'])
{
case "tampildata";
//---------------------
if (isset($_GET['aksitampilkan'])){
switch ($_GET['aksitampilkan']){
case "inputpengembalian";
mysql_query("update anggota set stts = 'nonaktif' where no_agt='$_POST[no_agt]'");
echo '<script>alert(\'Anggota Perpustakaan Ini Telah Dinonaktifkan\')
	setTimeout(\'location.href="?modul=bebaspustaka&aksi=tampil"\' ,0);</script>';
//START - Membuat Kode Otomatis
$qr	= mysql_query("SELECT MAX(CONCAT(LPAD((RIGHT((no_bebas_pustaka),7)+1),7,'0')))FROM bebas_pustaka");
$qr2	= mysql_query("SELECT MIN(CONCAT(LPAD((RIGHT((no_bebas_pustaka),7)),7,'0')))FROM bebas_pustaka");	
$kde= mysql_fetch_array($qr);
$kde2= mysql_fetch_array($qr2);
if ($kde2[0]!="0000001"){
$kodea = "0000001";
}
else{
$kodea = $kde[0];
} 
//FINISH - Membuat Kode Otomatis
//START - Mengambil Tanggal Sekarang
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tglsekarang = date("Y-m-d", $tanggal);
//END - Mengambil Tanggal Sekarang
mysql_query("insert into bebas_pustaka values('BBS$kodea','$_POST[no_agt]','$tglsekarang')");		
break;
}
}
if(isset($_POST['no_anggota'])){
$query=mysql_query("select * from anggota where no_agt = '$_POST[no_anggota]' and stts='aktif'");
echo"<h2>Bebas Anggota Pustaka</h2>";
echo"<center>";
$tampil=mysql_fetch_array($query);
if(empty($tampil['no_agt'])) {
echo "Anggota Tidak Ada / Nonaktif";
}else{
echo "<table border='0' width='700'>
<tr>
	<td width='39%'>No Anggota</td><td> : $tampil[no_agt]</td><td rowspan='4'><img width='70px' height='90' src='images/anggota/resize.php?src=$tampil[no_agt].jpg&scale=200&q=100'/></td>
</tr>
<tr>
	<td>Nama Anggota</td><td> : $tampil[nama]</td>
</tr>
<tr>
	<td>Alamat</td><td> : $tampil[alamat]</td>
</tr></table>";
$querycek = mysql_query("select * from anggota,peminjaman where anggota.no_agt = peminjaman.no_agt and peminjaman.no_agt = '$tampil[no_agt]' and anggota.stts = 'aktif' and peminjaman.status = 'dipinjam'");
$cekpeminjaman = mysql_fetch_array($querycek);
if (empty($cekpeminjaman['no_agt'])) {
echo "<form action='?modul=bebaspustaka&aksi=tampil&cari=tampildata&aksitampilkan=inputpengembalian' method='POST'>
<input type='hidden' value='$tampil[no_agt]' name='no_agt'/>
<input type='submit' value='Bebaskan Dari Anggota Perpustakaan'/>
</form>";
}else
{
echo "</br></br><span style='color:red'><b>Masih Ada Meminjam Buku</b></span>";
}
}
}else{
echo '_';
}
break;
}
}
break;

}
}
echo '<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>';
?>
