<?php
 $q=$_GET['q'];
  include "../../koneksi/koneksi.php";
 $my_data=mysql_real_escape_string($q);
 //$mysqli=mysql_connect('localhost','root','','databasename') or die("Database Error");
 $sql="SELECT no_induk_buku FROM buku where no_induk_buku like '%$my_data%' and jumlah_eksemplar > 0 ORDER BY no_induk_buku";
 $result = mysql_query($sql) or die(mysql_error());

 if($result)
 {
  while($row=mysql_fetch_array($result))
  {
   echo $row['no_induk_buku']."\n";
  }
 }
?>