<?php
if(!isset($_SESSION['userpus'])) {
header("Location: index.php");
}else{
switch ($_GET['aksi'])
{
//TAMPIL CARI
case "tampil";
echo '<h3>Pencarian Data</h3>';
echo '<style>
#belakang:hover
{
background-color:silver;
border : 0px solid white;
    -moz-border-radius : 25px;
    -webkit-border-radius : 25px;
	-moz-box-shadow: 0 0 2px 2px #9b7e7e;
-webkit-box-shadow: 0 0 2px 2px#9b7e7e;
box-shadow: 0 0 2px 2px #9b7e7e;
width:110px;
}
</style>';
echo '<a href="?modul=pencarian&aksi=transaksi" title="Pencarian Data Transaksi"><img id="belakang" src="images/penjualan.png" width="100px"/></a>';
echo '<a href="?modul=pencarian&aksi=pelanggan" title="Pencarian Data Pelanggan"><img id="belakang" src="images/customer.png" width="100px"/></a>';
echo '<a href="?modul=pencarian&aksi=produk" title="Pencarian Data Produk"><img id="belakang" src="images/produk.png" width="100px"/></a>';
break;
//TAMPIL TRANSAKSI
case "buku";
echo '<h3>Pencarian Data Buku</h3>
</br><form>
		<font face="verdana" size="2">Ketikkan Data Buku Yang Ingin Di Cari : </font><input type="text" name="no_induk_buku" id="no_induk_buku" size="25" onkeyup="tampilbuku(no_induk_buku.value)" />
	<br />
	<div id="pencarianbuku"></div>';
break;
case "anggota";
echo '<h3>Pencarian Data Anggota</h3>
</br><form>
		<font face="verdana" size="2">Ketikkan Data Anggota Yang Ingin Di Cari : </font><input type="text" name="no_agt" id="no_agt" size="25" onkeyup="tampilanggota(no_agt.value)" />
	<br />
	<div id="pencariananggota"></div>';
break;
case "peminjaman";
echo '<h3>Pencarian Data Peminjaman</h3><form>
		<font face="verdana" size="2">Ketikkan Data Peminjaman : </font><input type="text" name="no_peminjaman" id="no_peminjaman" size="25" onkeyup="tampilpeminjaman(no_peminjaman.value)" />
	
	<br />
	<div id="pencarianpeminjaman"></div>';
break;
case "produk";
echo '<h3>Pencarian Data Produk</h3><form>
		<font face="verdana" size="2">Ketikkan Data Produk Yang Ingin Di Cari : </font><input type="text" name="id_produk" id="id_produk" size="25" onkeyup="tampilbarang(id_produk.value)" />
	
	<br />
	<div id="pencarianbarang"></div>';
break;
}
}

echo '<iframe width=174 height=189 name="gToday:normal:calender/agenda.js" id="gToday:normal:calender/agenda.js" src="calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>';

?>