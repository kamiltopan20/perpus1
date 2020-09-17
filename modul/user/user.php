<?php
if((!isset($_SESSION['userpus'])) || ($_SESSION['levelpus']!="Ketua")) {
header("Location: index.php");
}else{
switch ($_GET['aksi'])
{
//INTERFACE TAMPIL DATA
case "tampil";
$sqlCount = "select count(user) from login";
$rsCount = mysql_fetch_array(mysql_query($sqlCount));
$banyakData = $rsCount[0];
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;
$mulai_dari = $limit * ($page - 1);
$sql_limit = "select * from login order by user limit $mulai_dari, $limit";
$query=mysql_query($sql_limit);;
echo"<h2>Data User Pengguna Sistem</h2>";
echo"<input type=button value='Tambah Data User' onclick=location.href='?modul=user&aksi=tambahuser'></br></br>";
echo"<center><table id='tabel' style='width:1050px; font-size:11px;'>
<tr bgcolor='#0b2070' style=\"color:#FFFFFF\" align='center'>
<td width='10%'>Username</td>
<td width='13%'>Nama</td>
<td width='5%'>Level</td>
<td width='20%'>Alamat</td>
<td width='7%'>Kota</td>
<td width='10%'>Kode Pos</td>
<td width='10%'>Nomor Telefon</td>
<td width='10%'>Tempat Lahir</td>
<td width='15%'>Tanggal Lahir</td>";
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
echo"<td>$tampil[user]</td>";
echo"<td>$tampil[nama]</td>";
echo"<td>$tampil[level]</td>";
echo"<td>$tampil[alamat]</td>";
echo"<td>$tampil[kota]</td>";
echo"<td>$tampil[kode_pos]</td>";
echo"<td>$tampil[no_telp]</td>";
echo"<td>$tampil[tempat_lahir]</td>";
echo"<td>$tampil[tanggal_lahir]</td>";
if ($_SESSION['levelpus'] == "Ketua"){
echo"<td><a href='?modul=user&aksi=edituser&id=$tampil[user]'>Ubah</td>";
echo"<td><a onclick=\"return confirm('Anda Yakin Menghapus Data Ini?')\" href='?modul=user&aksi=hapus&id=$tampil[user]'>Hapus</td>";
}

$no++;
$baris++;}
echo"</tr>";
echo"</table></center>";
$banyakHalaman = ceil($banyakData / $limit);
echo '</br><div id="page" style="font-size:17px">Halaman: ';
for($i = 1; $i <= $banyakHalaman; $i++){
 if($page != $i){
 echo '  [<a href="index.php?modul=pelanggan&aksi=tampil&page='.$i.'">'.$i.'</a>]  ';
 }else{
 echo "[<span style='color:silver'>$i</span>] ";
 }
}
break;

//INTERFACE TAMBAH
case "tambahuser":
echo"<h2>Tambah Data User</h2>";
echo "<center><table id='tabeledit'><form action='?modul=user&aksi=input' name='postform' method=POST>
<tr><td>Username : </td><td>
<input type=text name='user'  size='40' maxlength='80'></td></tr>
<tr><td>Password</td><td>
<input type=password name='password' maxlength='10'></td></tr>
<tr><td>Nama : </td><td>
<input type=text name='nama'  size='40' maxlength='80'></td></tr>
<tr><td>Level : </td><td>
<select name='level'><option value='Ketua'>Ketua</option><option value='Pustakawan'>Pustakawan</option><option value='Member'>Member</option></select></td></tr>
<tr><td>Alamat : </td><td>
<input size='40' type='text' name='alamat' />
</td></tr>
<tr><td>Kota : </td><td>
<input size='40' type='text' name='kota' />
</td></tr>
<tr><td>Kode Pos : </td><td>
<input size='40' type=text name='kode_pos' maxlength='8'></td></tr>
<tr><td>Nomor Telepon : </td><td>
<input size='40' type=text name='no_telp' maxlength='20'></td></tr>
<tr><td>Tempat Lahir : </td><td>
<input size='40' type=text name='tempat_lahir' maxlength='20'></td></tr>
<tr><td>Tanggal Lahir : </td><td><input size='35' type='text' name='tanggal_lahir' onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal_lahir);return false;\"/><a href=\"javascript:void(0)\" onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.tanggal_lahir);return false;\" ><img name=\"popcal\" align=\"absmiddle\" style=\"border:none\" src=\"./calender/calender.jpeg\" width=\"26\" height=\"21\" border=\"0\" alt=\"\"></a></td></tr>
	<tr><td colspan=2 align=center><input type=submit value='Save'>
			<input type=button onclick=self.history.back()  value='Batal'>
	</td></tr></form></table></center>";
break;

//INTERFACE EDIT
case "edituser":
echo"<h2>Edit Data User</h2>
<h4><i>Harus Menggunakan Password</i></h4>";
$db="select * from login where user='$_GET[id]'";
$qri=mysql_query($db);
$row=mysql_fetch_array($qri);
echo"<form action='?modul=user&aksi=update&user=$row[user]' name='postform2' method=POST>";
echo"<center><table id='tabeledit'>";
echo"<tr><td>Username : </td><td><input style='background-color:#eeeeff'; readonly='1' type=text name='user' value='$row[user]'></td></tr>";
echo"<tr><td>Password Lama: </td><td><input type=password name='passwordlama'></td></tr>";
echo"<tr><td>Password Baru: </td><td><input type=password name='password'></td></tr>";
echo"<tr><td>Nama : </td><td><input type=text name='nama' value='$row[nama]'></td></tr>";
echo"<tr><td>Level : </td><td><input type=text name='level' value='$row[level]' readonly></td></tr>";
echo"<tr><td>Alamat : </td><td><input type=text name='alamat' value='$row[alamat]'></td></tr>";
echo"<tr><td>Kota : </td><td><input type=text name='kota' value='$row[kota]'></td></tr>";
echo"<tr><td>Kode Pos : </td><td><input type=text name='kode_pos' value='$row[kode_pos]'></td></tr>";
echo"<tr><td>Nomor Telepon : </td><td><input type=text name='no_telp' value='$row[no_telp]'></td></tr>";
echo"<tr><td>Tempat Lahir : </td><td><input type=text name='tempat_lahir' value='$row[tempat_lahir]'></td></tr>";
echo"<tr><td>Tanggal Lahir : </td><td><input size='35' type='text' value='$row[tanggal_lahir]' name='tanggal_lahir' onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform2.tanggal_lahir);return false;\"/><a href=\"javascript:void(0)\" onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform2.tanggal_lahir);return false;\" ><img name=\"popcal\" align=\"absmiddle\" style=\"border:none\" src=\"./calender/calender.jpeg\" width=\"26\" height=\"21\" border=\"0\" alt=\"\"></a></td></tr>";
echo"<tr><td colspan=2 align=center><input type=submit name='save'  value='UpDate'>
	<input type=button onclick=self.history.back()  value='Batal'></td></tr>";
echo"</table></center>";
break;

// AKSI HAPUS
case "hapus":
mysql_query("DELETE FROM login WHERE user='$_GET[id]'");
	echo '<script>setTimeout(\'location.href="?modul=user&aksi=tampil"\' ,0);</script>';
break;

// AKSI INPUT
case "input":
$querycek=mysql_query("select * from login where user = '$_POST[user]'");
$tampilcek=mysql_fetch_array($querycek);
if (empty($_POST['user']) or empty($_POST['password']))
{
echo"<p>Username Dan Password Harus Diisi !<input type='button' onclick=self.history.back() value='back'/>";

}
elseif ($tampilcek['user'] == $_POST['user']){
echo '<script>alert(\'Username Sudah Ada ! !\')
	setTimeout(\'location.href="?modul=user&aksi=tampil"\' ,0);</script>';
}
Else
{		
  mysql_query("INSERT INTO login VALUES('$_POST[user]','".md5($_POST['password'])."','$_POST[nama]','$_POST[level]','$_POST[alamat]','$_POST[kota]','$_POST[kode_pos]','$_POST[no_telp]','$_POST[tempat_lahir]','$_POST[tanggal_lahir]')"); 	  
echo 'Data Berhasil Dimasukkan Dengan Data Sebagai Berikut :</br></br>';
$query=mysql_query("select * from login where user = '$_POST[user]'");
while($tampil=mysql_fetch_array($query)){ 
echo"<center><table border='0' style='width:300px; font-size:11px;' align='center'>
<tr><td width='50%'>Username</td><td> : $tampil[user]</td></tr>
<tr><td>Password</td><td> : *******</td></tr>
<tr><td>Nama</td><td> : $tampil[nama]</td></tr>
<tr><td>Alamat</td><td> : $tampil[alamat]</td></tr>
<tr><td>Kota</td><td> : $tampil[kota]</td></tr>
<tr><td>Kode Pos</td><td> : $tampil[kode_pos]</td></tr>
<tr><td>Telp</td><td> : $tampil[no_telp]</td></tr>
<tr><td>Tempat Lahir</td><td> : $tampil[tempat_lahir]</td></tr>
<tr><td>Tanggal Lahir</td><td> : $tampil[tanggal_lahir]</td></tr>
</table></br></br><a href='index.php?modul=user&aksi=tampil'><b>Kembali</b></a></center>";
}
								}
break;

// AKSI UPDATE
case "update":
$cekpass = mysql_fetch_array(mysql_query("select password from login where user = '$_POST[user]'"));
if ($cekpass['password'] == md5($_POST['passwordlama'])){
mysql_query("UPDATE login SET user = '$_POST[user]',
password = '".md5($_POST['password'])."',
nama = '$_POST[nama]',
level = '$_POST[level]',
alamat='$_POST[alamat]',
kota = '$_POST[kota]',
kode_pos = '$_POST[kode_pos]',
no_telp = '$_POST[no_telp]',
tempat_lahir = '$_POST[tempat_lahir]',
tanggal_lahir = '$_POST[tanggal_lahir]'
where user='$_GET[user]'");
echo '<script>alert(\'Data Berhasil Diedit\')
	setTimeout(\'location.href="?modul=user&aksi=tampil"\' ,0);</script>';
	}else{
	echo '<script>alert(\'Password Salah !\')
setTimeout(\'location.href="?modul=user&aksi=tampil"\' ,0);</script>';
	}
break;
}

}
?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>