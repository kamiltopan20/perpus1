<?php
echo '<html>
<head>
<title>Data Anggota</title>
<style>
#tabel
{
font-size:15px;
border-collapse:collapse;
}
#tabel  td
{
padding-left:5px;
border: 1px solid black;
}
</style>
</head>
<body>';

include "../../koneksi/koneksi.php";
$sql_limit = "select * from anggota order by no_agt";
$query=mysql_query($sql_limit);
echo"<center>
<h3>Laporan Data Anggota</h3>
<table id='tabel' style='width:1200px' border='1'>
<tr align='center'>
<td width='10%'>No Agt</td>
<td width='10%'>NAMA</td>
<td width='10%'>JK</td>
<td width='10%'>Tempat Lahir</td>
<td width='10%'>Tanggal Lahir</td>
<td width='30%'>Alamat</td>";

$no=1;
$baris=1;

while($tampil=mysql_fetch_array($query)){ 
echo "<tr>"; 
echo"<td>$tampil[no_agt]</td>";
echo"<td>$tampil[nama]</td>";
echo"<td>$tampil[jenis_kelamin]</td>";
echo"<td>$tampil[tempat_lahir]</td>";
echo"<td>$tampil[tanggal_lahir]</td>";
echo"<td>$tampil[alamat]</td>";
}
echo"</tr>";
echo"</table></center></body>
</html>";
?>