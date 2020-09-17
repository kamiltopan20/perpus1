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
$sql_limit = "select * from pengembalian,peminjaman,anggota where (peminjaman.no_agt = anggota.no_agt) and (pengembalian.no_peminjaman = peminjaman.no_peminjaman) and (pengembalian.tgl_pengembalian between '$_POST[dari]' and '$_POST[sampai]') order by peminjaman.no_peminjaman DESC";
$query=mysql_query($sql_limit);
echo"<center>
<h3>Laporan Denda</h3>
Dari Tanggal \"$_POST[dari]\" Sampai \"$_POST[sampai]\"
<table id='tabel' style='width:1100px' border='1'>
<tr align='center'>
<td width='10%'>No</td>
<td width='8%'>No Agt</td>
<td width='15%'>Nama</td>
<td width='10%'>Kode Buku</td>
<td width='30%'>Buku</td>
<td width='10%'>Tgl Pinjam</td>
<td width='10%'>Tgl Kembali</td>
<td width='10%'>Tgl Terima</td>
<td width='10%'>Denda</td>";
$no=1;
$baris=1;
$jmlhdenda = 0;
while($tampil=mysql_fetch_array($query)){ 
echo "<tr>"; 
echo"<td>$tampil[no_peminjaman]</td>";
echo"<td>$tampil[no_agt]</td>";
echo"<td>$tampil[nama]</td>";
echo"<td>$tampil[kode_buku]</td>";
echo"<td>$tampil[buku]</td>";
echo"<td>$tampil[tgl_pinjam]</td>";
echo"<td>$tampil[tgl_kembali]</td>";
echo"<td>$tampil[tgl_pengembalian]</td>";
echo"<td>$tampil[denda]</td>";
$jmlhdenda+=$tampil['denda'];
}
echo"</tr>";
echo"</table></br></br>Total Denda : $jmlhdenda</center>";
?>
</body>
</html>