<?php
if(!isset($_SESSION['userpus'])) {
header("Location: index.php");
}else{
switch ($_GET['aksi'])
{
//INTERFACE TABLE BROWSER
case "tampil";

echo"<h2>Pencarian Khusus Buku</h2><center>
<div style='width:1050px; height:50px; vertical-align:midle; text-align:left'>";
echo "<center><form action='index.php?modul=pencariankhusus&aksi=cari' method='POST'>Cari Berdasarkan :
<select name='kategori'>
<option value=''>--Pilih Kategori--</option>
<option value='judul'>Judul Buku</option>
<option value='kota_terbit'>Lokasi (Kota Terbit)</option>
<option value='selesai_diproses'>Tanggal Selesai Diproses</option>
<option value='penerbit'>Penerbit</option>
<option value='pengarang'>Pengarang</option><input type='text' name='query'/>
</select><input type='submit' value='Cari'/></form></center>";
break;

case "cari";
$key=str_replace("'", "''",$_POST['query']);
$tampil=str_replace("''", "'",$key);
if(empty($_POST['kategori'])){
echo '<script>alert(\'Pilih Kategori..!!\')
	setTimeout(\'location.href="?modul=pencariankhusus&aksi=tampil"\' ,0);</script>';
}else{
if($_POST['kategori']=='judul'){
$query=mysql_query("select * from buku where judul like '%$key%' order by no_induk_buku");
}elseif($_POST['kategori']=='kota_terbit'){
$query=mysql_query("select * from buku where kota_terbit like '%$key%' order by no_induk_buku");
}elseif($_POST['kategori']=='selesai_diproses'){
$query=mysql_query("select * from buku where selesai_diproses like '%$key%' order by no_induk_buku");
}elseif($_POST['kategori']=='penerbit'){
$query=mysql_query("select * from buku where penerbit like '%$key%' order by no_induk_buku");
}elseif($_POST['kategori']=='pengarang'){
$query=mysql_query("select * from buku where pengarang like '%$key%' order by no_induk_buku");
}
}
echo"<h2>Data Buku</h2>
<input type=button onclick=self.history.back()  value='Kembali'>";

echo"<center><div style='overflow:auto;height:400px;width:1000px;padding:0px;margin-bottom:0px'>  <table id='tabel' style='width:900px; font-size:11px;'>
<tr bgcolor='#0b2070' style=\"color:#FFFFFF\" align='center'>
<td width='8%'>No Induk</td>

<td width='8%'>Pengarang</td>
<td width='20%'>Judul</td>
<td width='10%'>Penerbit</td>
<td width='10%'>Kota Terbit</td>
<td width='10%'>Jumlah Eksemplar</td>
<td width='10%'>Selesai Diproses</td>
<td width='10%'>Barcode</td>
";

$no=1;
$baris=1;
function hightlight($str, $keywords = '')
{
$keywords = preg_replace('/\s\s+/', ' ', strip_tags(trim($keywords))); // filter

$style = 'highlight';
$style_i = 'highlight_important';

/* Apply Style */

$var = '';

foreach(explode(' ', $keywords) as $keyword)
{
$replacement = "<span class='".$style."'>".$keyword."</span>";
$var .= $replacement." ";

$str = str_ireplace($keyword, $replacement, $str);
}
$str = str_ireplace(rtrim($var), "<span class='".$style_i."'>".$keywords."</span>", $str);
return $str;
}
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

if($_POST['kategori']=='pengarang'){
echo"<td>".hightlight($tampil['pengarang'],$_POST['query'])."</td>";
}else{
echo"<td>$tampil[pengarang]</td>";
}
if($_POST['kategori']=='judul'){
echo"<td>".hightlight($tampil['judul'],$_POST['query'])."</td>";
}else{
echo"<td>$tampil[judul]</td>";
}
if($_POST['kategori']=='penerbit'){
echo"<td>".hightlight($tampil['penerbit'],$_POST['query'])."</td>";
}else{
echo"<td>$tampil[penerbit]</td>";
}
if($_POST['kategori']=='kota_terbit'){
echo"<td>".hightlight($tampil['kota_terbit'],$_POST['query'])."</td>";
}else{
echo"<td>$tampil[kota_terbit]</td>";
}
echo"<td>$tampil[jumlah_eksemplar]</td>";
if($_POST['kategori']=='selesai_diproses'){
echo"<td>".hightlight($tampil['selesai_diproses'],$_POST['query'])."</td>";
}else{
echo"<td>$tampil[selesai_diproses]</td>";
}

echo"<td><img src='modul/buku/barcode.php?encode=CODE128&bdata=$tampil[no_induk_buku]&height=50&scale=1.5&bgcolor=%23FFFFFF&color=%23000000&file=&type=png'/></td>";
$no++;
$baris++;}
echo"</tr>";
echo"</table></div></center>";
break;

//INTERFACE TAMBAH
case "tambahanggota":
if ($_SESSION['levelpus']=="Ketua") {
$qr	= mysql_query("SELECT MAX(CONCAT(LPAD((RIGHT((no_agt),7)+1),7,'0')))FROM anggota");
$qr2	= mysql_query("SELECT MIN(CONCAT(LPAD((RIGHT((no_agt),7)),7,'0')))FROM anggota");	
$kde= mysql_fetch_array($qr);
$kde2= mysql_fetch_array($qr2);
if ($kde2[0]!="0000001"){
$kodea = "0000001";
}
else{
$kodea = $kde[0];
}   	
echo"<h2>Tambah Anggota</h2>";
echo "<center><table id='tabeledit'>
<form action='?modul=anggota&aksi=input' name='postform'
		method='POST'
		enctype='multipart/form-data'>
<tr><td>Pilih Gambar : </td><td>
<input type='file' name='berkas'  /></td></tr>
<form method='POST'>
<tr><td>No Anggota : </td><td>
<input style='background:transparent'; size='30' type='text' name='no_agt' value='AGT$kodea' maxlength='30' readonly></td></tr>
	<tr><td>Nama : </td><td>
<input size='30' type='text' name='nama' maxlength='30'></td></tr>
	<tr><td>Jenis Kelamin : </td><td>
<select name='jenis_kelamin'><option value='Laki-Laki'>Laki-Laki</option><option value='Perempuan'>Perempuan</option></select></td></tr>
<tr><td>Tempat Lahir : </td><td>
<input size='30' type=text name='tempat_lahir' maxlength='20'></td></tr>
<tr><td>Tanggal Lahir : </td><td>
<input size='25' type='text' name='tanggal_lahir' onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal_lahir);return false;\"/><a href=\"javascript:void(0)\" onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal_lahir);return false;\" ><img name=\"popcal\" align=\"absmiddle\" style=\"border:none\" src=\"./calender/calender.jpeg\" width=\"26\" height=\"21\" border=\"0\" alt=\"\"></a>
</td></tr>
<tr><td style='vertical-align:top'>Alamat : </td><td>
<textarea name='alamat' maxlength='80' rows='3' cols='30'></textarea></td></tr>
	<tr><td colspan=2 align=center><input type=submit value='Save'>
			<input type=button onclick=self.history.back()  value='Batal'>
	</td></tr></form></form></table></center>";
	}
break;

//INTERFACE EDITUSER
case "editanggota":
echo"<h2>Edit User</h2>";
$db="select * from anggota where no_agt='$_GET[nis]'";
$qri=mysql_query($db);
$row=mysql_fetch_array($qri);
echo"<tr><td colspan='2'><img width='70px' height='90' src='images/anggota/resize.php?src=$row[no_agt].jpg&scale=200&q=100'/></td></tr>";
echo"
<form action='?modul=anggota&aksi=update&no_agt=$row[no_agt]' name='postform2'
		method='POST'
		enctype='multipart/form-data'>
<tr><td>Ubah Foto : </td><td>
<input type='file' name='berkas'  /></td></tr>
<form method='POST'>";
echo"<center><table id='tabeledit'>";
echo"<tr><td>Nomor Anggota : </td><td><input style='background-color:#eeeeff'; readonly='1' type=text name='no_agt' value='$row[no_agt]'></td></tr>";
echo'<tr><td>Nama : </td><td><input maxlength=30 type=text name="nama" value="'.$row['nama'].'"></td></tr>';
echo"<tr><td>Jenis Kelamin : </td><td><select name='jenis_kelamin'>";
if ($row['jenis_kelamin'] == "Laki-Laki") {
echo "<option value='Laki-Laki'>Laki-Laki</option><option value='Perempuan'>Perempuan</option>";
}
else 
{
echo "<option value='Perempuan'>Perempuan</option><option value='Laki-Laki'>Laki-Laki</option>";
}
echo "</select></td></tr>";
echo'<tr><td>Tempat Lahir : </td><td><input maxlength=20 type=text name="tempat_lahir" value="'.$row['tempat_lahir'].'"></td></tr>';
echo"<tr><td>Tanggal Lahir : </td><td><input type=text name='tanggal_lahir' onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform2.tanggal_lahir);return false;\" value='$row[tanggal_lahir]'><a href=\"javascript:void(0)\" onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal_lahir);return false;\" ><img name=\"popcal\" align=\"absmiddle\" style=\"border:none\" src=\"./calender/calender.jpeg\" width=\"26\" height=\"21\" border=\"0\" alt=\"\"></a></td></tr>";
echo "
<tr><td style='vertical-align:top'>Alamat : </td><td>
<textarea name='alamat' maxlength='80' rows='3' cols='30'>$row[alamat]</textarea>
</td></tr>";
echo"<tr><td colspan=2 align=center><input type=submit name='save'  value='UpDate'></form></form>
	<input type=button onclick=self.history.back()  value='Batal'></td></tr>";
echo"</table></center>";
break;

//HAPUS
case "hapus":
mysql_query("DELETE FROM anggota WHERE no_agt='$_GET[id]'");
	echo '<script>alert(\'Data Berhasil Dihapus\')
	setTimeout(\'location.href="?modul=anggota&aksi=tampil"\' ,0);</script>';
	unlink("images/anggota/$_GET[id].jpg");
break;

//INPUT
case "input":
if (empty($_POST['nama']) or empty($_POST['jenis_kelamin']) or empty($_POST['tempat_lahir']) or empty($_POST['tanggal_lahir']) or empty($_POST['alamat']))
{
echo"<p>Salahsatu Textbox tidak terisi<input type='button' onclick=self.history.back() value='back'/>";

}
Else
{		
//UPLOAD
error_reporting(0);
$maxUp=3000000;
$tes = $_POST['no_agt'];
$extensionList = array("bmp", "jpg", "gif");
$error = $_FILES['berkas']['error'];//error
$nama_file = $_FILES['berkas']['name'];//Name
/* New File Name */
$newname = substr( $nama_file , -3 );
$newname2 = substr( $nama_file , +3 );
$pecah = explode(".", $nama_file);
$ekstensi = $pecah[1];
$ukuran = $_FILES['berkas']['size'];//Size Byte
$temp = $_FILES['berkas']['tmp_name'];//Temporary
$tipe_data= $_FILES['berkas']['type'];//Type data
$extension=end(explode(".", $nama_file));
$newfilename="$tes".".".$extension;


$tujuan = "images/anggota/".$newfilename;//destination



if ($ukuran>$maxUp) {
echo "<script>
	alert('Ukuran File Foto Terlalu Besar, Maximal 3 mb!');
	</script>";
	echo '<script>setTimeout(\'location.href="?modul=anggota&aksi=tampil"\' ,0);</script>';
}
elseif ($nama_file == ""){
echo '<script>alert(\'Gambar Belum Dipilih . . !\')
	setTimeout(\'location.href="?modul=anggota&aksi=tambahanggota"\' ,0);</script>';
}
/*elseif ($newname != "jpg" && $newname != "bmp" && $newname != "gif"){
	echo "<script>alert('Gagal..! Anda hanya bisa memasukkan file jpg, bmp, dan gif..!')</script></br>";
	}*/
elseif ($error >0){
	echo "Error";
}
elseif (file_exists($tujuan)){
	echo $nama_file ." sudah ada , ganti dengan file lainnya";
	}
else{
	move_uploaded_file($temp,$tujuan);
	//echo"ukuran File Anda : $ukuran "."Byte</br>";
	//echo" File Disimpan di ".$tujuan;
	//echo "</br></br>$tes";
		$nama = str_replace("'", "''",$_POST['nama']);
		$tempat_lahir = str_replace("'", "''",$_POST['tempat_lahir']);
		$alamat = str_replace("'", "''",$_POST['alamat']);
		$sql = mysql_query("INSERT INTO anggota VALUES('$_POST[no_agt]','$nama','$_POST[jenis_kelamin]','$tempat_lahir','$_POST[tanggal_lahir]','$alamat','aktif')"); 		
		if (!$sql)
		{
		echo "Gagal Memasukkan Database,</br>
		Pastikan Data Yang Dimasukkan Benar.</br>
		<input type='button' onclick=self.history.back() value='Kembali'/>";
		}else
		{
		echo '<script>alert(\'Data Berhasil Dimasukkan\')
			setTimeout(\'location.href="?modul=anggota&aksi=tampil"\' ,0);</script>';
		}	 
	}
//END UPLOAD
	   
 
								}
break;

//UPDATE USER
case "update":
error_reporting(0);
$maxUp=3000000;
$tes = $_POST['no_agt'];
$extensionList = array("bmp", "jpg", "gif");
$error = $_FILES['berkas']['error'];//error
$nama_file = $_FILES['berkas']['name'];//Name
/* New File Name */
$newname = substr( $nama_file , -3 );
$newname2 = substr( $nama_file , +3 );
$pecah = explode(".", $nama_file);
$ekstensi = $pecah[1];
$ukuran = $_FILES['berkas']['size'];//Size Byte
$temp = $_FILES['berkas']['tmp_name'];//Temporary
$tipe_data= $_FILES['berkas']['type'];//Type data
$extension=end(explode(".", $nama_file));
$newfilename="$tes".".".$extension;


$tujuan = "images/anggota/".$newfilename;//destination



if ($ukuran>$maxUp) {
echo "<script>
	alert('Ukuran File Foto Terlalu Besar, Maximal 3 mb!');
	</script>";
	echo '<script>setTimeout(\'location.href="?modul=anggota&aksi=tampil"\' ,0);</script>';
}
else{
move_uploaded_file($temp,$tujuan);
	//echo"ukuran File Anda : $ukuran "."Byte</br>";
	//echo" File Disimpan di ".$tujuan;
	//echo "</br></br>$tes";
	$nama = str_replace("'", "''",$_POST['nama']);
		$tempat_lahir = str_replace("'", "''",$_POST['tempat_lahir']);
		$alamat = str_replace("'", "''",$_POST['alamat']);
$sql = mysql_query("UPDATE anggota SET no_agt='$_POST[no_agt]',
                            	 nama='$nama',
                                jenis_kelamin='$_POST[jenis_kelamin]',
                               	tempat_lahir='$tempat_lahir',
tanggal_lahir='$_POST[tanggal_lahir]',
alamat='$alamat' 			
			where no_agt='$_GET[no_agt]'");
			if (!$sql)
		{
		echo "Gagal Memasukkan Database,</br>
		Pastikan Data Yang Dimasukkan Benar.</br>
		<input type='button' onclick=self.history.back() value='Kembali'/>";
		}else
		{
		echo '<script>alert(\'Data Berhasil Diedit\')
	setTimeout(\'location.href="?modul=anggota&aksi=tampil"\' ,0);</script>';
		}	 

break;
}
}

}
?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>