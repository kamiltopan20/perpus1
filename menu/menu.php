<?php
echo '<div id="menu">';
if(!isset($_SESSION['userpus'])) {
echo '<ul><li><a href="index.php"><center>Home</center></a></li>';
echo '<ul><li><a href="?login"><center>Login</center></a></li>';
//echo '<ul><li><a href="index.php?modul=te"><center>E-Book</center></a></li>';
//echo '<ul><li><a href="index.php?modul=pemesanan&aksi=tambahpemesanan"><center>Pesan Buku</center></a></li>';
//echo '<ul><li><a href="index.php?modul=profil"><center>Profil</center></a></li>';

}
elseif($_SESSION['levelpus'] == "Ketua") {
echo '<ul><li><a href="index.php"><center>Home</center></a></li>
	<li><a href="#"><center>Data</center></a> 
  	   	<ul>
        	<li><a href="index.php?modul=anggota&aksi=tampil">Data Anggota</a></li>
        	<li><a href="index.php?modul=buku&aksi=tampil">Data Buku</a></li> 
			
			
		   	</ul>
  		</li>
    	<li><a href="index.php?modul=peminjaman&aksi=tampil"><center>Peminjaman</center></a></li>
    	<li><a href="index.php?modul=pengembalian&aksi=tampil"><center>Pengembalian</center></a></li>
		
		
		
    	<li><a href="#"><center>Cetak</center></a>
    	<ul>
        	<li><a href="index.php?modul=laporanpinjam&aksi=tampil">Laporan Peminjaman</a></li>
			<li><a href="index.php?modul=laporandenda&aksi=tampil">Laporan Pengembalian</a></li>
			
			';
			
			echo '
  	   	</ul>
		<li><a href="login/aksilogout.php"><center>Logout</center></a></li>
			</ul>';
echo'  
</div>
';
}elseif($_SESSION['levelpus'] == "Pustakawan") {
echo '<ul><li><a href="index.php"><center>Home</center></a></li>
	<li><a href="#"><center>Data</center></a> 
  	   	<ul>
        	<li><a href="index.php?modul=anggota&aksi=tampil">Data Anggota</a></li>	
  	   	</ul>
  		</li>
    	<li><a href="index.php?modul=peminjaman&aksi=tampil"><center>Peminjaman</center></a></li>
    	<li><a href="index.php?modul=pengembalian&aksi=tampil"><center>Pengembalian</center></a></li>
		<li><a href="#"><center>Pencarian</center></a>
		<ul>
		<li><a href="index.php?modul=pencariankhusus&aksi=tampil">Pencarian Khusus Buku</a></li>
			<li><a href="index.php?modul=pencarian&aksi=buku">Cari Data Buku</a></li>
			<li><a href="index.php?modul=pencarian&aksi=peminjaman">Cari Data Peminjaman</a></li>
  	   	</ul>
		</li>
		<li><a href="login/aksilogout.php"><center>Logout</center></a></li>
			</ul>
</div>
';
}elseif($_SESSION['levelpus'] == "Member") {
echo '<ul><li><a href="index.php"><center>Home</center></a></li>
<ul><li><a href="index.php?modul=viewdata"><center>Data Transaksi</center></a></li>
	<ul><li><a href="index.php?modul=ebook"><center>Ebook</center></a></li>
		<li><a href="login/aksilogout.php"><center>Logout</center></a></li>
			</ul>
</div>
';
}
echo '</div>
</center></div>
<style>
#widget-melayang
{
margin:10px 0 10px 10px;
padding: 4px; 
background: #FFFFFF; 
border: 1px solid #fff;
border-radius: 10px;
-webkit-border-radius: 10px;-moz-border-radius: 10px;
-webkit-box-shadow: #600 0 2px 12px;
-moz-box-shadow: #600 0 2px 7px; 
text-shadow:0 1px 0 #FFFFFF; width:230px; height:auto;
position: fixed; 
top: 2px; 
right: 200px; 
font-family: 
Helvetica, arial, sans-serif; 
float:left;
width:500px;
}
</style>
';
?>
