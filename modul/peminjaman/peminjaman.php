<?php
error_reporting(0);
if(!isset($_SESSION['userpus'])) {
header("Location: index.php");
}else{

switch ($_GET['aksi'])
{
case "tampil";
echo '<h3>Peminjaman</h3>';
echo '<center><form action="?modul=peminjaman&aksi=tampil&cari=tampildata" method="POST">Masukkan No Anggota :<input type="text" name="no_anggota"/><i>tekan enter</i></form></center>';
if(isset($_GET['cari'])){
switch ($_GET['cari'])
{
case "tampildata";

if(isset($_GET['aksicari'])){
switch ($_GET['aksicari'])
{
case "hapus":
mysql_query("DELETE FROM peminjaman WHERE no_peminjaman='$_GET[id]'");
mysql_query("update buku set jumlah_eksemplar = jumlah_eksemplar+1 where no_induk_buku = '$_GET[no_induk_buku]'");
	
	
break;
case "inputpeminjaman";
$cekkeberadaanbuku = mysql_fetch_array(mysql_query("select no_induk_buku from buku where no_induk_buku ='$_POST[kode_buku]'"));
$ceksatu = mysql_fetch_array(mysql_query("select jumlah_eksemplar from buku where no_induk_buku ='$_POST[kode_buku]'"));
$cekjumlahpinjam = mysql_fetch_array(mysql_query("select count(no_agt) as no_anggota from peminjaman where no_agt = '$_POST[no_anggota]'"));
if (empty($_POST['no_anggota']))
{
echo '<script>alert(\'Gagal . . . !!! No Anggota Tidak Diisi\')</script>';
}elseif($cekjumlahpinjam['no_anggota'] >= 3){
echo '<script>alert(\'Gagal . . . !!! Peminjaman Tidak Boleh Lebih Dari 3 Buku !!\')</script>';
}
elseif ($ceksatu['jumlah_eksemplar'] <= 0){
echo '<script>alert(\'Gagal . . . !!! Stok Buku Tidak Ada. Buku Tidak Dapat Dipinjam !!\')</script>';
}
Elseif (empty($_POST['kode_buku']))
{
echo '<script>alert(\'Gagal . . . !!! No Induk Buku Belum Diisi\')</script>';
}
else
{	
$qry	= mysql_query("SELECT MAX(CONCAT(LPAD((RIGHT((no_peminjaman),8)+1),8,'0')))FROM peminjaman");
$qry2	= mysql_query("SELECT MIN(CONCAT(LPAD((RIGHT((no_peminjaman),8)),8,'0')))FROM peminjaman");	
$kode= mysql_fetch_array($qry);
$kode2= mysql_fetch_array($qry2);
$singkatanggota = substr($_POST['no_anggota'],0,4);
if ($kode2[0]!="00000001"){
$kodeauto = "00000001";
}
else{
$kodeauto = $kode[0];
}   	
$tampiljudul=mysql_fetch_array(mysql_query("select judul from buku where no_induk_buku =  '$_POST[kode_buku]'")); 
if (empty($_POST['judulbuku'])){
$tampiljdl = $tampiljudul['judul'];
}else{
$tampiljdl = $_POST['judulbuku'];
}
  mysql_query("INSERT INTO peminjaman VALUES('PM$kodeauto','$_POST[no_anggota]','$_POST[kode_buku]','$tampiljdl','$_POST[tgl_pinjam]','$_POST[tgl_kembali]','dipinjam')"); 		
mysql_query("update buku set jumlah_eksemplar = jumlah_eksemplar-1 where no_induk_buku = '$_POST[kode_buku]'");
 // echo '<script>setTimeout(\'location.href="?modul=peminjaman&aksi=tampil&cari=tampildata"\' ,0);</script>';
								}
break;
}
}
//-------------------------------

if(isset($_POST['no_anggota'])){
//BERHASIL
$query=mysql_query("select * from anggota where no_agt = '$_POST[no_anggota]' and stts = 'aktif'");
echo"<h2>Kartu Peminjaman</h2>";
echo"<center>";
$tampil=mysql_fetch_array($query);
if(empty($tampil['no_agt'])) {
echo "Anggota Tidak Ada / Nonaktif";
}else{
echo "<table border='0' width='700'>
<tr>
	<td width='39%'>No Anggota</td><td> : $tampil[no_agt]</td><td rowspan='4'>
<img width='70px' height='90' src='images/anggota/AGT0000004.jpg'></td>
</tr>
<tr>
	<td>Nama Anggota</td><td> : $tampil[nama]</td>
</tr>
<tr>
	<td>Alamat</td><td> : $tampil[alamat]</td>
</tr>
</table>
</center>";
$query2=mysql_query("select * from peminjaman where no_agt = '$_POST[no_anggota]' and status = 'dipinjam'");
echo"<center><table id='tabel' style='width:900px; font-size:11px;'>
<tr bgcolor='#0b2070' style=\"color:#FFFFFF\" align='center'>
<td width='4%'>No.</td>
<td width='18%'>No Induk Buku</td>
<td width='60'>Buku</td>
<td width='20%'>Tanggal Pinjam</td>
<td width='25%'>Tanggal Kembali</td>";
$no=1;
$baris=1;
while($tampil2=mysql_fetch_array($query2)){ 
if($baris%2==0)
{
echo "<tr bgcolor=\"#d9e2da\">"; 
}
else 
{
echo "<tr bgcolor=\"#FFFFFF\">"; 
}
echo"<td align='center'>$no</td>";
echo"<td>$tampil2[kode_buku]</td>";
echo"<td>$tampil2[buku]</td>";
echo"<td>$tampil2[tgl_pinjam]</td>";
echo"<td>$tampil2[tgl_kembali]</td>";
echo"<form action='?modul=peminjaman&aksi=tampil&cari=tampildata&aksicari=hapus&id=$tampil2[no_peminjaman]&no_induk_buku=$tampil2[kode_buku]' method='POST'><td><input type='hidden' value='$tampil2[no_agt]' name='no_anggota'/><input type='submit' value='Batal'/></td></form>";
$no++;
$baris++;}

date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tglsekarang = date("Y-m-d", $tanggal);
$tambahwaktu = date("Y-m-d", mktime(0,0,0,date("m"),date("d")+7,date("Y"))); 
echo"</tr>
<tr>
<td></td><form action='?modul=peminjaman&aksi=tampil&cari=tampildata&aksicari=inputpeminjaman' method='POST' name='postform'>
<td>
<input size='5' name='no_anggota' type='hidden' value='$tampil[no_agt]'/>
<input style='background:transparent; border:0px solid black' size='20' name='kode_buku' id='kode_buku' onload='bukutamu(kode_buku.value)' onclick='bukutamu(kode_buku.value)' onkeyup='bukutamu(kode_buku.value)' type='text'/></td>
<td><div id='pencarian'><input type='text' style='background:transparent; border:0px solid black' size='40' name='judulbuku'/ disabled></div></td>
<td><input style='background:transparent; border:0px solid black' size='10' type='text' name='tgl_pinjam' value='$tglsekarang' onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.tgl_pinjam);return false;\"/><a href=\"javascript:void(0)\" onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.tgl_pinjam);return false;\" ><img name=\"popcal\" align=\"absmiddle\" style=\"border:none\" src=\"./calender/calender.jpeg\" width=\"26\" height=\"21\" border=\"0\" alt=\"\"></a></td>
<td><input style='background:transparent; border:0px solid black' size='10' type='text' name='tgl_kembali' value='$tambahwaktu' onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.tgl_kembali);return false;\"/><a href=\"javascript:void(0)\" onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.tgl_kembali);return false;\" ><img name=\"popcal\" align=\"absmiddle\" style=\"border:none\" src=\"./calender/calender.jpeg\" width=\"26\" height=\"21\" border=\"0\" alt=\"\"></a><input type='submit' value='enter'/>
</td>
</tr>
";
echo"</table></center>
<script language=\"Javascript\">
document.postform.kode_buku.focus()
</script>
</form>";
echo "</br><form action='index.php?modul=peminjaman&aksi=tampil' method='post'><input type='submit' value='Selesai Peminjaman'/></form></br>*cara peminjaman : ketikkan kode buku di bagian no induk buku, jika sudah muncul kode, pilih dan \"tekan enter\" </br>lalu Tekan Enter Kembali Untuk Memasukkan Data</br>
<span style='color:red'>*Sistem Tidak Menampilkan Buku Yang Statusnya Dipinjam</span>";

}

}else{
echo 'tidak ada';
}
break; //end case tampilcari
}
}    // akhir isser cari
break; //end case tampil

//HAPUS



//INPUT
case "input":

break;

//UPDATE USER
case "update":
break;

case "baru";
break;
}



}




?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
</body>