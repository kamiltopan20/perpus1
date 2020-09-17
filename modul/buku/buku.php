<?php
if((!isset($_SESSION['userpus'])) || ($_SESSION['levelpus']!="Ketua")) {
header("Location: index.php");
}else{
switch ($_GET['aksi'])
{
//INTERFACE TAMPIL DATA BUKU
case "tampil";
$query=mysql_query("select * from buku");
echo"<h2>Data Buku</h2>";
echo"<input type=button value='Tambah Data Buku' onclick=location.href='?modul=buku&aksi=tambahbuku'></br></br>";
echo"<center><div style='overflow:auto;height:400px;width:1000px;padding:0px;margin-bottom:0px'>  <table id='tabel' style='width:1000px; font-size:11px;'>
<tr bgcolor='#0b2070' style=\"color:#FFFFFF\" align='center'>
<td width='8%'>No Induk</td>

<td width='8%'>Pengarang</td>
<td width='20%'>Judul</td>
<td width='8%'>Lokasi Rak</td>
<td width='10%'>Penerbit</td>
<td width='10%'>Jumlah</td>
<td colspan='4' width='10%'>Action</td>

";

$no=1;
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
echo"<td>$tampil[no_induk_buku]</td>";

echo"<td>$tampil[pengarang]</td>";
echo"<td>$tampil[judul]</td>";
echo"<td>$tampil[lokasirak]</td>";
echo"<td>$tampil[penerbit]</td>";
echo"<td>$tampil[jumlah_eksemplar]</td>";

echo"<td width='4%' align='center'><a href=?modul=buku&aksi=detail&no=$tampil[no_induk_buku]>Detail</td>";
echo"<td width='4%' align='center'><a href=?modul=buku&aksi=editbuku&kode_buku=$tampil[no_induk_buku]><image src='images/edit.png'/></td>";
echo"<td width='4%' align='center'><a onclick=\"return confirm('Anda Yakin Menghapus Data Ini?')\" href='?modul=buku&aksi=hapus&id=$tampil[no_induk_buku]'><image src='images/delete.png'/></td>";
echo"<td width='4%'><a href='modul/buku/tampilbarcode.php?text=$tampil[no_induk_buku]' target='_blank'/><image src='images/bc.png'/></a>
</td>";
$no++;
$baris++;}
echo"</tr>";
echo"</table></div></center>";
break;

//DETAIL
case "detail":
$query=mysql_query("select * from buku where no_induk_buku = '$_GET[no]'");
while($tampil=mysql_fetch_array($query)){ 
echo"<center><table border='0' style='width:300px; font-size:11px;' align='center'>
<tr><td width='50%'>No Induk Buku</td><td> : $tampil[no_induk_buku]</td></tr>

<tr><td>Pengarang</td><td> : $tampil[pengarang]</td></tr>
<tr><td>Judul</td><td> : $tampil[judul]</td></tr>
<tr><td>Lokasi Rak</td><td> : $tampil[lokasirak]</td></tr>

<tr><td>Penerbit</td><td> : $tampil[penerbit]</td></tr>
<tr><td>Kota Terbit</td><td> : $tampil[kota_terbit]</td></tr>
<tr><td>Tahun Terbit</td><td> : $tampil[tahun_terbit]</td></tr>
<tr><td>ISBN</td><td> : $tampil[ISBN]</td></tr>
<tr><td>Jumlah</td><td> : $tampil[jumlah_eksemplar]</td></tr>
<tr><td>Tanggal Input</td><td> : $tampil[selesai_diproses]</td></tr>
</table></br></br><a href='index.php?modul=buku&aksi=tampil'><b>Kembali</b></a></center>";
}
break;
//END DETAIL

//INTERFACE TAMBAH
case "tambahbuku":
echo"<h2>Tambah Buku</h2>";
echo "<center><table id='tabeledit'><form action='?modul=buku&aksi=input' name='postform' method=POST>
<tr><td>Nomor Induk Buku : </td><td>
<input size='35' type='text' name='no_induk_buku' maxlength='20'></td></tr>
	
	<tr><td>Pengarang : </td><td>
<input size='35' type='text' name='pengarang' maxlength='60'></td></tr>
<tr><td>Judul : </td><td>
<textarea name='judul' maxlength='80' rows='3' cols='30'></textarea></td></tr>
<tr><td>Lokasi Rak : </td><td>
<textarea name='lokasirak' maxlength='30' rows='3' cols='30'></textarea></td></tr>
<tr><td>Penerbit : </td><td>
<input size='35' type=text name='penerbit' maxlength='20'></td></tr>
<tr><td>Kota Terbit : </td><td>
<input type=text name='kota_terbit' maxlength='20'></td></tr>
<tr><td>Tahun Terbit : </td><td>
<input type=text name='tahun_terbit' maxlength='4'></td></tr>
<tr><td>ISBN : </td><td>
<input type=text name='ISBN' maxlength='40'></td></tr>
<tr><td>Jumlah: </td><td>
<input type=text name='jumlah' maxlength='40'></td></tr>
<tr><td>Tanggal Input : </td><td>
<input size='10' type='text' name='selesai_diproses' onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.selesai_diproses);return false;\"/><a href=\"javascript:void(0)\" onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.selesai_diproses);return false;\" ><img name=\"popcal\" align=\"absmiddle\" style=\"border:none\" src=\"./calender/calender.jpeg\" width=\"26\" height=\"21\" border=\"0\" alt=\"\"></a>
</td></tr>

	<tr><td colspan=2 align=center><input type=submit value='Save'>
			<input type=button onclick=self.history.back()  value='Batal'>
	</td></tr></form></table></center>";
break;

//INTERFACE EDIT BUKU
case "editbuku":
echo"<h2>Edit Data Buku</h2>";
$db="select * from buku where no_induk_buku='$_GET[kode_buku]'";
$qri=mysql_query($db);
$row=mysql_fetch_array($qri);
echo"<form action='?modul=buku&aksi=update&kode_buku=$row[no_induk_buku]' method=POST name='postform'>";
echo"<center><table id='tabeledit'>";

	echo '

	<tr><td>Pengarang : </td><td>
<input size="35" type="text" name="pengarang" maxlength="60" value="'.$row['pengarang'].'"></td></tr>';
echo "
<tr><td>Judul : </td><td>
<textarea name='judul' maxlength='80' rows='3' cols='30'>$row[judul]</textarea></td></tr>
<tr><td>Lokasi Rak : </td><td>
<textarea name='lokasirak' maxlength='30' rows='3' cols='30'>$row[lokasirak]</textarea></td></tr>
<tr><td>Penerbit : </td><td>";
echo '
<input size="35" type=text name="penerbit" maxlength="20" value="'.$row['penerbit'].'"></td></tr>
<tr><td>Kota Terbit : </td><td>
<input type=text name="kota_terbit" maxlength="20" value="'.$row['kota_terbit'].'"></td></tr>
';
echo "
<tr><td>Tahun Terbit : </td><td>
<input type=text name='tahun_terbit' maxlength='4' value='$row[tahun_terbit]'></td></tr>
<tr><td>ISBN : </td><td>
<input type=text name='ISBN' maxlength='40' value='$row[ISBN]'></td></tr>
<tr><td>Jumlah : </td><td>
<input type=text name='jumlah' maxlength='40' value='$row[jumlah_eksemplar]'></td></tr>
";
echo "
<tr><td>Tanggal Input : </td><td>
<input size='10' type='text' name='selesai_diproses' value='$row[selesai_diproses]' onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.selesai_diproses);return false;\"/><a href=\"javascript:void(0)\" onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.selesai_diproses);return false;\" ><img name=\"popcal\" align=\"absmiddle\" style=\"border:none\" src=\"./calender/calender.jpeg\" width=\"26\" height=\"21\" border=\"0\" alt=\"\"></a>
</td></tr>";
echo"<tr><td colspan=2 align=center><input type=submit name='save'  value='UpDate'>
	<input type=button onclick=self.history.back()  value='Batal'></td></tr>";
echo"</table></form></center>";
break;

// AKSI HAPUS
case "hapus":
mysql_query("DELETE FROM buku WHERE no_induk_buku='$_GET[id]'");
	echo '<script>alert(\'Data Berhasil Dihapus\')
	setTimeout(\'location.href="?modul=buku&aksi=tampil"\' ,0);</script>';
break;

// AKSI INPUT
case "input":
if ((empty($_POST['judul'])) or (empty($_POST['pengarang'])))
{
echo"<p>Pengarang dan Judul Wajib Diisi<input type='button' onclick=self.history.back() value='back'/>";
}
Else
{		


 $qry	= mysql_query("SELECT MAX(CONCAT(LPAD((RIGHT((no_induk_buku),4)+1),4,'0')))FROM buku");
$qry2	= mysql_query("SELECT MIN(CONCAT(LPAD((RIGHT((no_induk_buku),4)),4,'0')))FROM buku");	
$kode= mysql_fetch_array($qry);
$kode2= mysql_fetch_array($qry2);
if ($kode2[0]!="0001"){
$kodeauto = "0001";
}
else{
$kodeauto = $kode[0];
}  

$pengarang = str_replace("'", "''",$_POST['pengarang']);
$judul = str_replace("'", "''",$_POST['judul']);
$penerbit = str_replace("'", "''",$_POST['penerbit']);
$kota_terbit = str_replace("'", "''",$_POST['kota_terbit']);
$jumlah = str_replace("'", "''",$_POST['jumlah']);
$lokasirak = str_replace("'", "''",$_POST['lokasirak']);
 $sql = mysql_query("INSERT INTO buku VALUES('$_POST[no_induk_buku]','$pengarang','$judul','$lokasirak','$penerbit','$kota_terbit','$_POST[tahun_terbit]','$_POST[ISBN]','$jumlah','$_POST[selesai_diproses]')"); 


if (!$sql)
  {
  echo "Gagal Memasukkan Database,</br>
  Pastikan Data Yang Dimasukkan Benar.</br>
  <input type='button' onclick=self.history.back() value='Kembali'/>";
  }else
  {
  echo '<script>alert(\'Data Berhasil Dimasukkan\')
	setTimeout(\'location.href="?modul=buku&aksi=tampil"\' ,0);</script>';
  } 
}
								
break;

// AKSI UPDATE
case "update":

$pengarang = str_replace("'", "''",$_POST['pengarang']);
$judul = str_replace("'", "''",$_POST['judul']);
$jumlah = str_replace("'", "''",$_POST['jumlah']);
$lokasirak = str_replace("'", "''",$_POST['lokasirak']);
$penerbit = str_replace("'", "''",$_POST['penerbit']);
$kota_terbit = str_replace("'", "''",$_POST['kota_terbit']);
$diterima_dari = str_replace("'", "''",$_POST['diterima_dari']);
mysql_query("UPDATE buku SET 
							pengarang = '$pengarang',
							judul = '$judul',
							lokasirak = '$lokasirak',
							
							penerbit = '$penerbit',
							kota_terbit = '$kota_terbit',
							tahun_terbit = '$_POST[tahun_terbit]',
							
							ISBN = '$_POST[ISBN]',
							jumlah_eksemplar = '$jumlah',
							
							selesai_diproses = '$_POST[selesai_diproses]'
			where no_induk_buku='$_GET[kode_buku]'");
echo '<script>alert(\'Data Berhasil Diedit\')
	setTimeout(\'location.href="?modul=buku&aksi=tampil"\' ,0);</script>';
break;
}
echo '<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>';
}

?>