<?php
echo '<html>
<head>
<title>Laporan Peminjaman</title>
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
$sql_limit = "select * from peminjaman,anggota where (peminjaman.no_agt = anggota.no_agt) and (tgl_pinjam between '$_POST[dari]' and '$_POST[sampai]') order by no_peminjaman DESC";
$query=mysql_query($sql_limit);
$sub = substr($_POST['dari'],1,1);
//echo "$sub";
echo"<center>
<h3>Laporan Peminjaman</h3>
Dari Tanggal \"$_POST[dari]\" Sampai \"$_POST[sampai]\"
<table id='tabel' style='width:900px' border='1'>
<tr align='center'>
<td width='10%'>No</td>
<td width='8%'>No Agt</td>
<td width='15%'>Nama</td>
<td width='10%'>Kode Buku</td>
<td width='30%'>Buku</td>
<td width='10%'>Tgl Pinjam</td>
<td width='10%'>Tgl Kembali</td>
<td width='10%'>Status</td>";
$no=1;
$baris=1;
while($tampil=mysql_fetch_array($query)){ 
echo "<tr>"; 
echo"<td>$tampil[no_peminjaman]</td>";
echo"<td>$tampil[no_agt]</td>";
echo"<td>$tampil[nama]</td>";
echo"<td>$tampil[kode_buku]</td>";
echo"<td>$tampil[buku]</td>";
echo"<td>$tampil[tgl_pinjam]</td>";
echo"<td>$tampil[tgl_kembali]</td>";
echo"<td>$tampil[status]</td>";
}
echo"</tr>";
echo"</table></center></br>
</body>
</html>";
?>