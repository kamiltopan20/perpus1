<?php

switch ($_GET['aksi'])
{
//INTERFACE TAMPIL DATA ANGGOTA
case "tampil";
if(!isset($_SESSION['userpus'])) {
echo '<script>alert(\'Tidak Berhak Mengakses Halaman Ini\')
	setTimeout(\'location.href="javascript:self.history.back()"\' ,0);</script>';
}else{
$query=mysql_query("select * from pemesanan,anggota where pemesanan.no_anggota = anggota.no_agt order by no_pemesanan desc");
echo"<h2>Data Pemesanan Buku</h2><center>";
echo"<table id='tabel' style='width:600px; font-size:11px;'>
<tr bgcolor='#0b2070' style=\"color:#FFFFFF\" align='center'>
<td width='4%'>No.</td>
<td width='15%'>No Anggota</td>
<td width='8%'>Nama</td>
<td width='30%'>Judul Buku</td>
<td width='10%'>Nama Pengarang</td>";

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
echo"<td align='center'>$no</td>";
echo"<td>$tampil[no_anggota]</td>";
echo"<td>$tampil[nama]</td>";
echo"<td>$tampil[judul_buku]</td>";
echo"<td>$tampil[nama_pengarang]</td>";
echo"<td width='3%'><a onclick=\"return confirm('Anda Yakin Menghapus Data Ini?')\" href='?modul=pemesanan&aksi=hapus&id=$tampil[no_pemesanan]'>Hapus</td>";
$no++;
$baris++;}
echo"</tr>";
echo"</table></center>";
}
break;

//INTERFACE TAMBAH
case "tambahpemesanan":
  	
echo"<h2>Tambah Pemesanan</h2>";
echo "<center><table id='tabeledit'>
<form action='?modul=pemesanan&aksi=input' name='postform'
		method='POST'
		enctype='multipart/form-data'>
<tr><td>No Anggota : </td><td>
<input style='background:transparent'; size='30' type='text' name='no_anggota' maxlength='30'></td></tr>
<tr><td style='vertical-align:top'>Judul Buku : </td><td>
<textarea name='judul_buku' maxlength='100' rows='3' cols='30'></textarea></td></tr>
<tr><td>Nama Pengarang : </td><td>
<input size='30' type=text name='nama_pengarang' maxlength='50'></td></tr>
	<tr><td colspan=2 align=center><input type=submit value='Save'>
			<input type=button onclick=self.history.back()  value='Batal'>
	</td></tr></form></form></table></center>";
	
break;

//INTERFACE EDIT
/*case "editanggota":
if(!isset($_SESSION['userpus'])) {
echo '<script>alert(\'Tidak Berhak Mengakses Halaman Ini\')
	setTimeout(\'location.href="javascript:self.history.back()"\' ,0);</script>';
}else{
echo"<h2>Edit User</h2>";
$db="select * from anggota where no_agt='$_GET[nis]'";
$qri=mysql_query($db);
$row=mysql_fetch_array($qri);
echo"<tr><td colspan='2'><img width='70px' height='90' src='images/anggota/resize.php?src=$row[no_agt].jpg&scale=200&q=100'/></td></tr>";
echo"
<form action='?modul=pemesanan&aksi=update&no_agt=$row[no_agt]' name='postform2'
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
}
break;*/

// AKSI HAPUS
case "hapus":
if(!isset($_SESSION['userpus'])) {
echo '<script>alert(\'Tidak Berhak Mengakses Halaman Ini\')
	setTimeout(\'location.href="javascript:self.history.back()"\' ,0);</script>';
}else{
mysql_query("DELETE FROM pemesanan WHERE no_pemesanan='$_GET[id]'");
	echo '<script>alert(\'Data Berhasil Dihapus\')
	setTimeout(\'location.href="?modul=pemesanan&aksi=tampil"\' ,0);</script>';
	}
break;

// AKSI INPUT
case "input":
$cekangg = mysql_fetch_array(mysql_query("select * from anggota where no_agt = '$_POST[no_anggota]'"));
if (empty($_POST['no_anggota']) or empty($_POST['judul_buku']) or empty($_POST['nama_pengarang']))
{
echo '<script>alert(\'Data Tidak Lengkap. Periksa Kembali\')
			setTimeout(\'location.href="javascript:self.history.back()"\' ,0);</script>';

}		
elseif(empty($cekangg['no_agt']))
{	
echo '<script>alert(\'Anggota Tidak Terdaftar\')
			setTimeout(\'location.href="javascript:self.history.back()"\' ,0);</script>';
}
else
{
		
		$judul_buku = str_replace("'", "''",$_POST['judul_buku']);
		$nama_pengarang = str_replace("'", "''",$_POST['nama_pengarang']);
		$sql = mysql_query("INSERT INTO pemesanan VALUES(NULL,'$_POST[no_anggota]','$judul_buku','$nama_pengarang')"); 		
		if (!$sql)
		{
		echo "Gagal Memasukkan Database,</br>
		Pastikan Data Yang Dimasukkan Benar.</br>
		<input type='button' onclick=self.history.back() value='Kembali'/>";
		}else
		{
		echo '<script>alert(\'Data Berhasil Dimasukkan\')
			setTimeout(\'location.href="javascript:self.history.back()"\' ,0);</script>';
		}	 
	}
//END UPLOAD
	   
break;

// AKSI UPDATE 
case "update":
if(!isset($_SESSION['userpus'])) {
echo '<script>alert(\'Tidak Berhak Mengakses Halaman Ini\')
	setTimeout(\'location.href="javascript:self.history.back()"\' ,0);</script>';
}else{
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
	echo '<script>setTimeout(\'location.href="?modul=pemesanan&aksi=tampil"\' ,0);</script>';
}
else{
move_uploaded_file($temp,$tujuan);
	
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
	setTimeout(\'location.href="?modul=pemesanan&aksi=tampil"\' ,0);</script>';
		}	 

break;
}
}
}


?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>