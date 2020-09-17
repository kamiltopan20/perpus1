<?php
echo '<html>
<head>
<title>Laporan Bebas Pustaka</title>
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
$sql_limit = "select * from bebas_pustaka,anggota where (bebas_pustaka.no_agt = anggota.no_agt) and (tgl_bebas_pustaka between '$_POST[dari]' and '$_POST[sampai]') order by no_bebas_pustaka DESC";
$query=mysql_query($sql_limit);
$sub = substr($_POST['dari'],1,1);
//echo "$sub";
echo"<center>
<h3>Laporan Bebas Pustaka</h3>
Dari Tanggal \"$_POST[dari]\" Sampai \"$_POST[sampai]\"
<table id='tabel' style='width:900px' border='1'>
<tr align='center'>
<td width='10%'>No Bebas Pustaka</td>
<td width='8%'>No Agt</td>
<td width='15%'>Nama</td>
<td width='10%'>Tgl Bebas Pustaka</td>
";
$no=1;
$baris=1;
while($tampil=mysql_fetch_array($query)){ 
echo "<tr>"; 
echo"<td>$tampil[no_bebas_pustaka]</td>";
echo"<td>$tampil[no_agt]</td>";
echo"<td>$tampil[nama]</td>";
echo"<td>$tampil[tgl_bebas_pustaka]</td>";

}
echo"</tr>";
echo"</table></center></br>
</body>
</html>";
?>