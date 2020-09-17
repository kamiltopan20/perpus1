<?php
if((!isset($_SESSION['userpus'])) || ($_SESSION['levelpus']!="Ketua")) {
header("Location: index.php");
}else{
switch ($_GET['aksi'])
{
//INTERFACE TAMPIL
case "tampil";
echo "<center>
<script>
function popup(form) {
    window.open('', 'denda', 'menubar=yes,scrollbars=yes,resizable=yes,width=800,height=400,top=50,left=200');
    form.target = 'denda';
}
</script>";
Echo '
<h3>Cetak Laporan Denda</h3>
<form action="modul/laporandenda/cetak.php" onsubmit="popup(this);" target="_blank" method="POST" name="postform"><table id="tabeledit">';
echo "<tr><td>
Dari Tanggal : </td>
<td><input type='date' name='dari'></td></tr>
<tr><td>Sampai Tanggal :</td><td><input type='date' name='sampai'></td></tr></table><input type='submit' value='Cetak'/></form>";
break;
}

}
echo '<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>';
?>