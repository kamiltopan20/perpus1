<?php
//buat konkesi
include "../../koneksi/koneksi.php";
mysql_select_db("perpus",$con);

//pencarian nama
echo "<font face=verdana size=2px>Yang Anda cari adalah : </font>".$key=$_GET['no_peminjaman'];
$result=mysql_query("select * from peminjaman,anggota,buku where (peminjaman.no_agt = anggota.no_agt) and (peminjaman.kode_buku = buku.no_induk_buku) and (peminjaman.buku like '%$key%' or buku.no_induk_buku like '%$key%' or status like '%$key%') order by no_peminjaman DESC",$con); 
$get_pages=mysql_num_rows($result);

if ($get_pages){
	?>
		<center><table id='tabel' style='width:900px; font-size:11px;'>
		<tr bgcolor='#0b2070' style="color:#FFFFFF" align='center'>
			<td width='10%'>No</td>
<td width='8%'>No Agt</td>
<td width='15%'>Nama</td>
<td width='10%'>No Induk Buku</td>

<td width='30%'>Judul</td>
<td width='10%'>Tgl Pinjam</td>
<td width='10%'>Tgl Kembali</td>
<td width='10%'>Status</td>
		</tr>
	<?php

	$no=1;
$baris=1;
	while ($tampil=mysql_fetch_array($result)){
	if($baris%2==0)
{
echo "<tr bgcolor=\"#d9e2da\">"; 
}
else 
{
echo "<tr bgcolor=\"#FFFFFF\">"; 
}
echo"<td>$tampil[no_peminjaman]</td>";
echo"<td>$tampil[no_agt]</td>";
echo"<td>$tampil[nama]</td>";
echo"<td>$tampil[kode_buku]</td>";

echo"<td>$tampil[buku]</td>";
echo"<td>$tampil[tgl_pinjam]</td>";
echo"<td>$tampil[tgl_kembali]</td>";
echo"<td>$tampil[status]</td>";
$no++;
$baris++;}
echo"</tr>";
echo"</table></center>";
	
	
	?></TABLE>
		<?php
}else{
	?><br /><b>Belum ada data!!</b><?php
}
?>