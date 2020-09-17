<?php
if((!isset($_SESSION['userpus'])) || ($_SESSION['levelpus']!="Ketua")) {
header("Location: index.php");
}else{
switch ($_GET['aksi'])
{
//INTERFACE TAMPIL
case "tampil";
$sqlCount = "select count(no_bebas_pustaka) from bebas_pustaka";
$rsCount = mysql_fetch_array(mysql_query($sqlCount));
$banyakData = $rsCount[0];
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;
$mulai_dari = $limit * ($page - 1);
$sql_limit = "select * from bebas_pustaka order by no_bebas_pustaka DESC limit $mulai_dari, $limit";
$query=mysql_query($sql_limit);;
echo"<h2>Data Bebas Pustaka</h2>";
echo"<center><table id='tabel' style='width:600px; font-size:11px;'>
<tr bgcolor='#0b7016' style=\"color:#FFFFFF\" align='center'>
<td width='10%'>No Bebas Pustaka</td>
<td width='13%'>Nomor Anggota</td>
<td width='13%'>Tanggal Bebas Pustaka</td>";
$no=1;
$baris=1;
while($tampil=mysql_fetch_array($query)){ 
if($baris%2==0)
{
echo "<tr bgcolor=\"#d9e2da\">"; 
}
else 
{
echo "<tr bgcolor=\"#FFFFFF\">"; 
}
echo"<td>$tampil[no_bebas_pustaka]</td>";
echo"<td>$tampil[no_agt]</td>";
echo"<td>$tampil[tgl_bebas_pustaka]</td>";
echo"<td width='13%' align='center'><a href='?modul=lihatbebaspustaka&aksi=aktif&no_agt=$tampil[no_agt]&no_bb=$tampil[no_bebas_pustaka]'>Aktifkan Kembali</a></td>";
$no++;
$baris++;}
echo"</tr>";
echo"</table></center>";
$banyakHalaman = ceil($banyakData / $limit);
echo '</br><div id="page" style="font-size:17px">Halaman: ';
for($i = 1; $i <= $banyakHalaman; $i++){
 if($page != $i){
 echo '  [<a href="index.php?modul=lihatbebaspustaka&aksi=tampil&page='.$i.'">'.$i.'</a>]  ';
 }else{
 echo "[<span style='color:silver'>$i</span>] ";
 }
}
break;
case "aktif";
mysql_query("update anggota set stts = 'aktif' where no_agt='$_GET[no_agt]'");
mysql_query("DELETE FROM bebas_pustaka WHERE no_bebas_pustaka='$_GET[no_bb]'");
echo '<script>alert(\'Anggota Perpustakaan Ini Telah Diaktifkan Kembali\')
	setTimeout(\'location.href="?modul=bebaspustaka&aksi=tampil"\' ,0);</script>';
break;
}
}
?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>