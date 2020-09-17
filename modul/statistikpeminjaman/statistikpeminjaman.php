<?php
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tglsekarang = date("Y-m-d", $tanggal);
if(!isset($_SESSION['userpus'])) {
header("Location: index.php");
}else{
switch ($_GET['aksi'])
{
//INTERFACE TABLE BROWSER
case "tampil";
date_default_timezone_set('Asia/Jakarta');
$tanggal= mktime(date("m"),date("d"),date("Y"));
$tglsekarang = date("Y-m-d", $tanggal);
$kurangwaktu = date("Y-m-d", mktime(0,0,0,date("m"),date("d")-7,date("Y")));
echo"<div id='jump'><h2>Statistik Peminjaman Buku</h2></div>";
echo "<form method='post' action='' name='postform'>Menampilkan Statistik Dari :
<input style='border:0px solid black' size='10' type='text' name='tgl_pinjam1' value='$kurangwaktu' onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.tgl_pinjam1);return false;\"/><a href=\"javascript:void(0)\" onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.tgl_pinjam1);return false;\" ><img name=\"popcal\" align=\"absmiddle\" style=\"border:none\" src=\"./calender/calender.jpeg\" width=\"26\" height=\"21\" border=\"0\" alt=\"\"></a> Sampai Tanggal <input style='border:0px solid black' size='10' type='text' name='tgl_pinjam2' value='$tglsekarang' onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.tgl_pinjam2);return false;\"/><a href=\"javascript:void(0)\" onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.tgl_pinjam2);return false;\" ><img name=\"popcal\" align=\"absmiddle\" style=\"border:none\" src=\"./calender/calender.jpeg\" width=\"26\" height=\"21\" border=\"0\" alt=\"\"></a><input type='submit' value='Tampilkan'/></form>";

if ((isset($_POST['tgl_pinjam1'])) && (isset($_POST['tgl_pinjam2']))){
echo "</br></br><b>Berikut Adalah Statistik Peminjaman Dari \"$_POST[tgl_pinjam1]\" Sampai \"$_POST[tgl_pinjam2]\"</b>";
}else{
echo "</br></br><b>Berikut Adalah Statistik Peminjaman Dari \"$kurangwaktu\" Sampai \"$tglsekarang\"</b>";
}
//echo"<input type=button value='Tambah Anggota' onclick=location.href='?modul=anggota&aksi=tambahanggota'></br></br>";
echo '<center><table border="1px" id="tabel" class="tabel" style="margin-top:30px" cellpadding="2" cellspacing="2">';
		echo '<tr><th class=kiri>TANGGAL PINJAM</th><th class=kanan>JUMLAH PINJAM</th></tr>';
		if ((isset($_POST['tgl_pinjam1'])) && (isset($_POST['tgl_pinjam2']))){
		$query = mysql_query("SELECT tgl_pinjam, count(tgl_pinjam) as total FROM peminjaman where tgl_pinjam between '$_POST[tgl_pinjam1]' and '$_POST[tgl_pinjam2]' GROUP BY tgl_pinjam ORDER BY tgl_pinjam ASC");
		}else{
		$query = mysql_query("SELECT tgl_pinjam, count(tgl_pinjam) as total FROM peminjaman where tgl_pinjam between '$kurangwaktu' and '$tglsekarang' GROUP BY tgl_pinjam ORDER BY tgl_pinjam ASC");
		}
		while ($row=mysql_fetch_array($query)){
			echo '<tr><td align = "center">'.$row['tgl_pinjam'].'</td><td align = "center">'.$row['total'].'</td></tr>';
		}
		echo '</table></center>';
		
		
//=====================
echo '<script type="text/javascript">
				$(\'#tabel\').convertToFusionCharts({
				swfPath: "plugin/Charts/",
				type: "msColumn3D",
				data: "#tabel",
				dataFormat: "HTMLTable",
				width: "900", height: "400"
				});
			</script>';
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
	<tr><td>NIRM : </td><td><input type=text maxlength='15' name='nirm'></td></tr>
	<tr><td>Nama : </td><td>
<input size='30' type='text' name='nama' maxlength='30'></td></tr>
	<tr><td>Jenis Kelamin : </td><td>
<select name='jenis_kelamin'><option value='Laki-Laki'>Laki-Laki</option><option value='Perempuan'>Perempuan</option></select></td></tr>
<tr><td>Tempat Lahir : </td><td>
<input size='30' type=text name='tempat_lahir' maxlength='20'></td></tr>
<tr><td>Tanggal Lahir : </td><td>
<input size='25' type='text' name='tanggal_lahir' onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal_lahir);return false;\"/><a href=\"javascript:void(0)\" onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal_lahir);return false;\" ><img name=\"popcal\" align=\"absmiddle\" style=\"border:none\" src=\"./calender/calender.jpeg\" width=\"26\" height=\"21\" border=\"0\" alt=\"\"></a>
</td></tr>
<tr><td>Program Studi : </td><td>
<input size='30' type=text name='prodi' maxlength='10'></td></tr>
<tr><td>Jurusan : </td><td>
<input size='30' type=text name='jurusan' maxlength='30'></td></tr>
<tr><td>Semester : </td><td>";
echo'
<select title="Semester" name="semester" id="semester" onChange="fsemester(semester.value)">
		<option value="" selected="selected">Pilih Semester</option>
		<option value="I">I</option>
		<option value="II">II</option>
		<option value="III">III</option>
		<option value="IV">IV</option>
		<option value="V">V</option>
		<option value="VI">VI</option>
		<option value="VII">VII</option>
		<option value="VIII">VIII</option>
		<option value="IX">IX</option>
		<option value="X">X</option>
		<option value="XI">XI</option>
		<option value="XII">XII</option>
		<option value="XIII">XIII</option>
		<option value="XIV">XIV</option>
</select>';
echo "</td></tr>
<tr><td>Kelas : </td><td>
<select name='kelas'><option>Pilih Kelas</option>
<option value='A'>A</option>
<option value='B'>B</option>
<option value='C'>C</option>
<option value='D'>D</option>
<option value='E'>E</option>
<option value='F'>F</option></select></td></tr>
<tr><td style='vertical-align:top'>Alamat : </td><td>
<textarea name='alamat' maxlength='80' rows='3' cols='30'></textarea></td></tr>
<tr><td>Tanggal Daftar : </td><td>
<input size='25' type='text' name='tanggal_daftar' value='$tglsekarang' onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal_daftar);return false;\"/><a href=\"javascript:void(0)\" onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal_daftar);return false;\" ><img name=\"popcal\" align=\"absmiddle\" style=\"border:none\" src=\"./calender/calender.jpeg\" width=\"26\" height=\"21\" border=\"0\" alt=\"\"></a>
</td></tr>
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
echo"<tr><td>NIRM : </td><td><input maxlength=15 type=text name='nirm' value='$row[nirm]'></td></tr>";
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
echo '<tr><td>Program Studi : </td><td>
<input maxlength=10 size="30" type=text name="prodi" value="'.$row['prodi'].'" maxlength="10"></td></tr>
<tr><td>Jurusan : </td><td>
<input maxlength=40 size="30" type=text value="'.$row['jurusan'].'" name="jurusan" maxlength="10"></td></tr>
<tr><td>Semester : </td><td>';
echo'
<select title="Semester" name="semester" id="semester">
		<option value="'.$row['semester'].'">'.$row['semester'].'</option>
		<option value="">Pilih Semester</option>
		<option value="I">I</option>
		<option value="II">II</option>
		<option value="III">III</option>
		<option value="IV">IV</option>
		<option value="V">V</option>
		<option value="VI">VI</option>
		<option value="VII">VII</option>
		<option value="VIII">VIII</option>
		<option value="IX">IX</option>
		<option value="X">X</option>
		<option value="XI">XI</option>
		<option value="XII">XII</option>
		<option value="XIII">XIII</option>
		<option value="XIV">XIV</option>
</select>';
echo "</td></tr>
<tr><td>Kelas : </td><td>
<select name='kelas'><option value='$row[kelas]'>$row[kelas]</option>
<option value=''>Pilih Kelas</option>
<option value='A'>A</option>
<option value='B'>B</option>
<option value='C'>C</option>
<option value='D'>D</option>
<option value='E'>E</option>
<option value='F'>F</option>
</select></td></tr>
<tr><td style='vertical-align:top'>Alamat : </td><td>
<textarea name='alamat' maxlength='80' rows='3' cols='30'>$row[alamat]</textarea>
</td></tr>";
echo"<tr><td>Tanggal Daftar : </td><td><input type=text name='tanggal_daftar' onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform2.tanggal_daftar);return false;\" value='$row[tanggal_daftar]'><a href=\"javascript:void(0)\" onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal_daftar);return false;\" ><img name=\"popcal\" align=\"absmiddle\" style=\"border:none\" src=\"./calender/calender.jpeg\" width=\"26\" height=\"21\" border=\"0\" alt=\"\"></a></td></tr>";
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
$query=mysql_query("select * from anggota where nirm = '$_POST[nirm]'");
$tampil=mysql_fetch_array($query);
if (empty($_POST['nirm']) or empty($_POST['nama']) or empty($_POST['jenis_kelamin']) or empty($_POST['tempat_lahir']) or empty($_POST['tanggal_lahir']) or empty($_POST['prodi']) or empty($_POST['jurusan']) or empty($_POST['semester']) or empty($_POST['kelas']) or empty($_POST['alamat']))
{
echo"<p>Salahsatu Textbox tidak terisi<input type='button' onclick=self.history.back() value='back'/>";

}elseif ($tampil['nirm'] == $_POST['nirm']){
echo '<script>alert(\'Data Sudah Ada . . !\')
	setTimeout(\'location.href="?modul=anggota&aksi=tampil"\' ,0);</script>';
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
	window.history.go(-1)</script>';
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
		$jurusan = str_replace("'", "''",$_POST['jurusan']);
		$prodi = str_replace("'", "''",$_POST['prodi']);
		$alamat = str_replace("'", "''",$_POST['alamat']);
		$sql = mysql_query("INSERT INTO anggota VALUES('$_POST[no_agt]','$_POST[nirm]','$nama','$_POST[jenis_kelamin]','$tempat_lahir','$_POST[tanggal_lahir]','$prodi','$jurusan','$_POST[semester]','$_POST[kelas]','$alamat','$_POST[tanggal_daftar]','aktif')"); 		
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
		$jurusan = str_replace("'", "''",$_POST['jurusan']);
		$prodi = str_replace("'", "''",$_POST['prodi']);
		$alamat = str_replace("'", "''",$_POST['alamat']);
$sql = mysql_query("UPDATE anggota SET no_agt='$_POST[no_agt]',
                                nirm='$_POST[nirm]',
								 nama='$nama',
                                jenis_kelamin='$_POST[jenis_kelamin]',
                               	tempat_lahir='$tempat_lahir',
tanggal_lahir='$_POST[tanggal_lahir]',
prodi='$prodi',
jurusan='$jurusan',
semester='$_POST[semester]',
kelas='$_POST[kelas]',
alamat='$alamat',
tanggal_daftar='$_POST[tanggal_daftar]'			
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