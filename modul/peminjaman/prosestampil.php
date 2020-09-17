<?php
error_reporting(0);
//buat konkesi
include "../../koneksi/koneksi.php";

//pencarian nama
$key=$_GET['kode_buku'];
$result=mysql_query("select judul from buku where no_induk_buku = '$key'",$con); 
$get_pages=mysql_num_rows($result);

if ($get_pages){
	?>
		
	<?php

	while ($row=mysql_fetch_array($result)){
		$id_bt=$row['judul'];
		?>
			<input name="buku" type="text" style="background:transparent; border:0px solid black" size="40" value="<?php echo $id_bt; ?>"/>
			
		
		<?php
	}
	
	?>
		<?php
}else{
	?><b><input name='buku' style='background:transparent; border:0px solid black' size='40' type='text'/></b><?php
}
?>