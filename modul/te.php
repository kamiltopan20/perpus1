<?php 

if(isset($_POST['cari_buku'])){
    $book =$_POST['cari_buku'];
}else{
  $book = '';
}
?>
<style>
   th{
     background-color:lightgreen;
   }
</style>
   
  <h1>Tabel Buku </h1>
  <form id="form1" name="form1" method="post" action="?page=tabel_ebook">
   
  </form>
  
  
  &nbsp;
  <table summary="Summary Here" cellpadding="0" cellspacing="0" align="center" border=1 style="border-collapse:collapse;">
   <thead>
     <tr>
         <th width="49">No</th>
         <th width="189">Judul</th>
         <th width="105">View </th>
     </tr>
   </thead>
   <tbody>

<?php
  $no =0;
  $cari = $book;
  $query = mysql_query("SELECT * FROM ebook WHERE judul LIKE '%$cari%' order by id");
  while ($data=mysql_fetch_array($query)){
?>
    <tr class="light">
      <td align="center"><?php echo $no=$no+1;?>.</td>
      <td><?php echo $data['judul']; ?></td>
      <td align="center"><a href="alert.php" target="_BLANK">View</a></td>
    </tr>
<?php
  }
?>
  
  </tbody>
 </table>
      
        <h1>&nbsp;</h1>
     