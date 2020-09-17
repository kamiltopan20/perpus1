<?php
if(!isset($_SESSION['userpus'])) {
header("Location: index.php");
}else{
switch ($_GET['aksi'])
{
case "tampil";
echo '<h3>Pengembalian</h3>';
echo '<center><form action="?modul=pengembalian&aksi=tampil&cari=tampildata" method="POST">Masukkan No Anggota :<input type="text" name="no_anggota"/><i>tekan enter</i></form></center>';
if(isset($_GET['cari'])){
switch ($_GET['cari'])
{
case "tampildata";
if (isset($_GET['aksitampilkan'])){
switch ($_GET['aksitampilkan']){
case "inputpengembalian";
if (empty($_POST['no_anggota']))
{
echo '<script>alert(\'Gagal . . . !!! No Anggota Tidak Diisi\')</script>';
}
Else
{	
mysql_query("update buku set jumlah_eksemplar = jumlah_eksemplar+1 where no_induk_buku = '$_POST[no_induk_buku]'");
mysql_query("update peminjaman set status = 'dikembalikan' where no_peminjaman='$_POST[no_peminjaman]'");	   
mysql_query("INSERT INTO pengembalian VALUES(NULL,'$_POST[no_peminjaman]','$_POST[tgl_pengembalian]',$_POST[denda])"); 			

							}
break;
}
}
if(isset($_POST['no_anggota'])){
$query=mysql_query("select * from anggota where no_agt = '$_POST[no_anggota]' and stts='aktif'");
echo"<h2>Kartu Peminjaman</h2>";
echo"<center>";
$tampil=mysql_fetch_array($query);
if(empty($tampil['no_agt'])) {
echo "Anggota Tidak Ada / Nonaktif";
}else{
echo "<table border='0' width='700'>
<tr>
	<td width='39%'>No Anggota</td><td> : $tampil[no_agt]</td><td rowspan='4'><img width='70px' height='90' src='images/anggota/AGT0000004.jpg'></td>
</tr>
<tr>
	<td>Nama Anggota</td><td> : $tampil[nama]</td>
</tr>
<tr>
	<td>Alamat</td><td> : $tampil[alamat]</td>
</tr>
</table>
</center>";
$query2=mysql_query("select * from peminjaman,anggota where (peminjaman.no_agt = anggota.no_agt) and (peminjaman.no_agt = '$_POST[no_anggota]') and (peminjaman.status = 'dipinjam')");
echo"<center><table id='tabel' style='width:750px; font-size:11px;'>
<tr bgcolor='#0b2070' style=\"color:#FFFFFF\" align='center'>
<td width='4%'>No.</td>
<td width='20%'>No Induk Buku</td>
<td width='40%'>Buku</td>
<td width='15%'>Tanggal Pinjam</td>
<td width='15%'>Tanggal Kembali</td>
<td width='15%'>Denda</td>
<td width='15%'>Action</td>";
$no=1;
$baris=1;
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tglsekarang = date("Y-m-d", $tanggal);
$pecah1 = explode("-", $tglsekarang);
$date1 = $pecah1[2];
$month1 = $pecah1[1];
$year1 = $pecah1[0];
$sekarang = GregorianToJD($month1, $date1, $year1);
$q=0;
while($tampil2=mysql_fetch_array($query2)){ 
if($baris%2==0)
{
echo "<tr bgcolor=\"#d9e2da\">"; 
}
else 
{
echo "<tr bgcolor=\"#FFFFFF\">"; 
}
echo "<form action='?modul=pengembalian&aksi=tampil&cari=tampildata&aksitampilkan=inputpengembalian' method='POST'>";
echo"<td align='center'>$no</td>";
echo"<td>$tampil2[kode_buku]</td>";
echo"<td>$tampil2[buku]</td>";
echo"<td>$tampil2[tgl_pinjam]</td>";
echo"<td>$tampil2[tgl_kembali]</td>";
$pecah2 = explode("-", $tampil2['tgl_kembali']);
$date2 = $pecah2[2];
$month2 = $pecah2[1];
$year2 = $pecah2[0];
$kembali = GregorianToJD($month2, $date2, $year2);
$selisih = $kembali - $sekarang;
$tampildenda = mysql_fetch_array(mysql_query("select * from tarif_denda"));
if ($selisih < 0) {
$denda = ($selisih * -1) * $tampildenda['tarif_denda'];
echo"<td><input type='hidden' value='$denda' name='denda'/>Rp".number_format($denda,2,',','.')."</td>";
$q+=$denda;
}else{
$denda = 0;
echo"<td><input type='hidden' value='$denda' name='denda'/>Rp".number_format($denda,2,',','.')."</td>";
$q+=$denda;
}
echo"
<td><input type='hidden' value='$tampil2[kode_buku]' name='no_induk_buku'/><input type='hidden' value='$tglsekarang' name='tgl_pengembalian'/><input type='hidden' value='$tampil2[no_peminjaman]' name='no_peminjaman'/><input type='hidden' value='$tampil2[no_agt]' name='no_anggota'/><input type='submit' value='kembalikan'/></td></form>";
$no++;
$baris++;
}
echo"</table></center></br>
Total Denda : Rp".number_format($q,2,',','.')."
<script language=\"Javascript\">
document.postform.kode_buku.focus()
</script>
</form></br><form action='index.php?modul=peminjaman&aksi=tampil' method='post'><input type='submit' value='Selesai Pengembalian'/></form>";
}
}else{
echo 'tidak ada';
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
