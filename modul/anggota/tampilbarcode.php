<?php
include "../../koneksi/koneksi.php";
$data=mysql_fetch_array(mysql_query("select * from anggota where no_agt = '$_GET[text]'"));
	echo "<html>
	<head>
		<title>Barcode</title>
		
<style>
#tabel
{
font-size:15px;
border-collapse:collapse;
font-family:arial;
}
#tabel  td
{
padding-left:5px;
border: 1px solid black;
}
#headkartu
{
font-family:arial; 
font-size:14pt;
font-weight:bold;
}
</style>
	</head>
	<body>
	<table id='tabel' style='width:750px; height:230px;'><tr>
	
	<td width='80px' style='vertical-align:center'><center>LOGO</center></td>
	<td colspan='2' width='295px' height='55px' style='vertical-align:center'><span id='headkartu'><center>Kartu Anggota </br>Perpusakaaan</center></span></td>
	
	<td width='375px'rowspan='3'><center>Kartu Perpustakaan Digunakan Untuk Meminjam, </br>Mengembalikan Buku,
dan Pada Saat Mengurus Surat Bebas Pustaka</br>
Dilarang Meminjamkan Kartu Kepada Orang Lain</br>
Jika Kartu Hilang, </br>Segera Hubungi Petugas Perpustakaan</center></td></tr>
	<tr><td height='100px' colspan='3' style='vertical-align:top; padding-top:10px; padding-left:20px;'>
	No Anggota : $data[no_agt]</br>
	Nama : $data[nama]</br>
	Alamat : $data[alamat]</br>
	</td></tr>
	<tr><td height='75px' colspan='2'><img src='../../images/anggota/".$_GET['text'].".jpg' width='50px'/></td><td>
	<center><image src='barcode.php?codetype=Code128&size=60&text=$_GET[text]'/></br>$_GET[text]</center></td></tr>
	</table>
	
	</body>
	</html>";
?>