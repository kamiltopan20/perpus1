<?php
//buat konkesi
include "../../koneksi/koneksi.php";
mysql_select_db("perpus",$con);

//pencarian nama
$key=str_replace("'", "''",$_GET['no_agt']);
$tampil=str_replace("''", "'",$key);
echo "<font face=verdana size=2px>Yang Anda cari adalah : </font>".$tampil;
$result=mysql_query("select * from anggota where no_agt like '%$key%' or nama like '%$key%' or tempat_lahir like '%$key%' or alamat like '%$key%' order by no_agt",$con); 
$get_pages=mysql_num_rows($result);

if ($get_pages){
	?>
		<center><table id='tabel' style='width:900px; font-size:11px;'>
		<tr bgcolor='#0b2070' style="color:#FFFFFF" align='center'>
			<td width='10%'>No Anggota</td>
			<td width='10%'>Nama</td>
			<td width='8%'>JK</td>
			<td width='20%'>Tempat Lahir</td>
			<td width='10%'>Tgl Lahir</td>
			<td width='10%'>Alamat</td>
		</tr>
	<?php

	$no=1;
$baris=1;
function hightlight($str, $keywords = '')
{
$keywords = preg_replace('/\s\s+/', ' ', strip_tags(trim($keywords))); // filter

$style = 'highlight';
$style_i = 'highlight_important';

/* Apply Style */

$var = '';

foreach(explode(' ', $keywords) as $keyword)
{
$replacement = "<span class='".$style."'>".$keyword."</span>";
$var .= $replacement." ";

$str = str_ireplace($keyword, $replacement, $str);
}
$str = str_ireplace(rtrim($var), "<span class='".$style_i."'>".$keywords."</span>", $str);
return $str;
}
	while ($tampil=mysql_fetch_array($result)){
	if($baris%2==0)
{
echo "<tr bgcolor=\"#d9e2da\">"; 
}
else 
{
echo "<tr bgcolor=\"#FFFFFF\">"; 
}

echo"<td>".hightlight($tampil['no_agt'],$key)."</td>";
echo"<td>".hightlight($tampil['nama'],$key)."</td>";
echo"<td>".hightlight($tampil['jenis_kelamin'],$key)."</td>";
echo"<td>".hightlight($tampil['tempat_lahir'],$key)."</td>";
echo"<td>".hightlight($tampil['tanggal_lahir'],$key)."</td>";
echo"<td>".hightlight($tampil['alamat'],$key)."</td>";
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