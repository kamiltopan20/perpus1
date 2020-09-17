<body>
<?php
$query=mysql_query("select * from anggota where no_agt = '".$_SESSION['userpus']."' and stts = 'aktif'");
echo"<h2>Kartu Peminjaman</h2>";
echo"<center>";
$tampil=mysql_fetch_array($query);
echo "<table border='0' width='700'>
<tr>
	<td width='39%'>No Anggota</td><td> : $tampil[no_agt]</td>
</tr>
<tr>
	<td>Nama Anggota</td><td> : $tampil[nama]</td>
</tr>
<tr>
	<td>Alamat</td><td> : $tampil[alamat]</td>
</tr>
</table>
</center>";

$query2=mysql_query("select * from peminjaman where no_agt = '".$_SESSION['userpus']."' and status = 'dipinjam'");
echo"<center><table id='tabel' style='width:900px; font-size:11px;'>
<tr bgcolor='#0b2070' style=\"color:#FFFFFF\" align='center'>
<td width='4%'>No.</td>
<td width='18%'>No Induk Buku</td>
<td width='60'>Buku</td>
<td width='20%'>Tanggal Pinjam</td>
<td width='25%'>Tanggal Kembali</td></tr>";
$no=1;
$baris=1;
while($tampil2=mysql_fetch_array($query2)){ 

echo "<tr bgcolor=\"#FFFFFF\">"; 

echo"<td align='center'>$no</td>";
echo"<td>$tampil2[kode_buku]</td>";
echo"<td>$tampil2[buku]</td>";
echo"<td>$tampil2[tgl_pinjam]</td>";
echo"<td>$tampil2[tgl_kembali]</td></tr>";
}
?>
</table>
</body>