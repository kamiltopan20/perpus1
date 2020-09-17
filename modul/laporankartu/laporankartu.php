<?php
if((!isset($_SESSION['userpus'])) || ($_SESSION['levelpus']!="Ketua")) {
header("Location: index.php");
}else{
switch ($_GET['aksi'])
{
//INTERFACE TABLE BROWSER
case "tampil";
echo "<center>
<script>
function popup(form) {
    window.open('', 'kembali', 'menubar=yes,scrollbars=yes,resizable=yes,width=800,height=400,top=50,left=200');
    form.target = 'kembali';
}
</script>";
Echo '
<h3>Cetak Kartu Anggota</h3>
<form action="modul/laporankartu/cetakkartu2.php" onsubmit="popup(this);" target="_blank" method="POST" name="postform"><table id="tabeledit">';
echo "<tr><td>
Yang Mendaftar Dari Tanggal : </td>
<td><input type='text' name='dari' onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.dari);return false;\"/><a href=\"javascript:void(0)\" onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.dari);return false;\" ><img name=\"popcal\" align=\"absmiddle\" style=\"border:none\" src=\"./calender/calender.jpeg\" width=\"26\" height=\"21\" border=\"0\" alt=\"\"></a></td></tr>
<tr><td>Sampai Tanggal :</td><td><input type='text' name='sampai' onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.sampai);return false;\"/><a href=\"javascript:void(0)\" onClick=\"if(self.gfPop)gfPop.fPopCalendar(document.postform.sampai);return false;\" ><img name=\"popcal\" align=\"absmiddle\" style=\"border:none\" src=\"./calender/calender.jpeg\" width=\"26\" height=\"21\" border=\"0\" alt=\"\"></a></td></tr></table><input type='submit' value='Cetak'/></form>";
break;
}

}
?>
<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>