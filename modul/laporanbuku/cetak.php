<?php
echo '<html>
<head>
<title>Data Buku</title>
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
$sql_limit = "select * from buku order by no_induk_buku";
$query=mysql_query($sql_limit);
echo"<center><div align='center'>
<h3>Laporan Data Buku</h3></div>
<table id='tabel' style='width:1200px' border='1'>
<tr align='center'>
<td width='10%'>No Induk Buku</td>

<td width='10%'>Pengarang</td>
<td width='10%'>Judul</td>
<td width='10%'>Penerbit</td>
<td width='5%'>Tahun Terbit</td>
<td width='10%'>Jumlah Buku</td>
<td width='5%'>Tanggal Input</td>";

$no=1;
$baris=1;

while($tampil=mysql_fetch_array($query)){ 
echo "<tr>"; 
echo"<td>$tampil[no_induk_buku]</td>";

echo"<td>$tampil[pengarang]</td>";
echo"<td>$tampil[judul]</td>";
echo"<td>$tampil[penerbit]</td>";
echo"<td>$tampil[tahun_terbit]</td>";
echo"<td>$tampil[jumlah_eksemplar]</td>";
echo"<td>$tampil[selesai_diproses]</td>";
}
echo"</tr>";
echo"</table></center>
</body>
</html>";
?>