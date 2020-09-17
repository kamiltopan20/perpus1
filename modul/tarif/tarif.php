<?php
if((!isset($_SESSION['userpus'])) || ($_SESSION['levelpus']!="Ketua")) {
header("Location: index.php");
}else{
switch ($_GET['aksi'])
{
//INTERFACE TAMPIL DATA TARIF
case "tampil";
$query=mysql_query("select * from tarif_denda");
echo"<h2>Tarif Denda Per Hari</h2>";
echo"<center><table id='tabel' style='width:300px; font-size:11px;'>
<tr bgcolor='#0b2070' style=\"color:#FFFFFF\" align='center'>
<td>Harga Denda</td>";
$baris=1;
while($tampil=mysql_fetch_array($query)){ 
if($baris%2==0)
{
echo "<tr bgcolor=\"#D9E2DA\">"; 
}
else 
{
echo "<tr bgcolor=\"#FFFFFF\">"; 
}
echo"<td align='center'><span style='font-size:20pt;'>Rp.$tampil[tarif_denda],-/Hari</span></td>";
echo"<td align='center'><a href=?modul=tarif&aksi=edittarif&id=$tampil[id_tarif]>Ubah</td>";
$baris++;}
echo"</tr>";
echo"</table></center>";
break;

//INTERFACE EDIT TARIF
case "edittarif":
echo"<h2>Edit Tarif Denda Per Hari</h2>";
$db="select * from tarif_denda where id_tarif='$_GET[id]'";
$qri=mysql_query($db);
$row=mysql_fetch_array($qri);
echo"<form action='?modul=tarif&aksi=update&id_tarif=$row[id_tarif]' method=POST>";
echo"<center><table id='tabeledit'>";
echo"<tr><td></td><td><input style='background-color:#eeeeff'; readonly='1' type=hidden name='id_tarif' value='$row[id_tarif]'></td></tr>";
echo"<tr><td>Tarif : </td><td><input type=text name='tarif' maxlength='10' value='$row[tarif_denda]'></td></tr>";
echo"<tr><td colspan=2 align=center><input type=submit name='save'  value='UpDate'>
	<input type=button onclick=self.history.back()  value='Batal'></td></tr>";
echo"</table></center>";
break;

// AKSI UPDATE TARIF
case "update":
mysql_query("UPDATE tarif_denda SET id_tarif='$_POST[id_tarif]',
                                tarif_denda='$_POST[tarif]'		
			where id_tarif='$_GET[id_tarif]'");
echo '<script>alert(\'Data Berhasil Diedit\')
	setTimeout(\'location.href="?modul=tarif&aksi=tampil"\' ,0);</script>';
break;
}
}

?>