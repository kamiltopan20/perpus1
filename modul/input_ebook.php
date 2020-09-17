<?php 
include_once 'include/koneksi.php';

if(empty($_SESSION['userpus'])){
header("location:index.php");	
}
?>

<html>
<head>
	<title>Form Mahasiswa</title>
		<style>
			body {
				background-image:url('./Image/4.jpg');
				}
		</style>
<body>



<form action="?modul=prosesupload" method="post" enctype="multipart/form-data" name="form_data_buku_SMPN_24_Padang" onSubmit="return validasi(this)">
<table width="700" border="0" align="center">
<tr bgcolor=#fffff>
<th colspan=3> ENTRY DATA E-BOOK SMP NEGERI 6 Gunung Talang </th>
</tr>

<tr>
<td><label>Judul</label></td>
<td>
<input name="judul" type="text" id="judul" size="25" maxlength="25"></td>
 </tr>
 
 <tr>
<td><label>Upload File </label></td>
<td>
<label></label>
<input type="file" name="file" ></td>

 </tr>
 <tr>
<td><label>Akses </label></td>
<td>
<label></label>
<select name="akses">
<option value="1"> View</option>
<option value="2"> Download</option>
</select></td>

 </tr>



<tr>
<td>
<td>
<input type="submit" name="SAVE" value="SIMPAN">
<input type="reset" name="CANCEL" value="BATAL">
</td>
</tr>
</table>


</tr>
</form>
<form action="" method="post" name="tabel">
  <table summary="Summary Here" cellpadding="0" cellspacing="0" align=center border=2 bgcolor=#fffff>
    <thead>
      <tr>
        <th width="37">No</th>
        <th width="126">Judul</th>
        <th width="149">Link</th>
        <th width="66">Hapus</th>
      </tr>
    </thead>
    <tbody>
      <?php
	$no =0;
	$query = mysql_query("SELECT * FROM ebook  order by id");
	while ($data=mysql_fetch_array($query)){
	?>
      <tr class="light">
        <td><?php echo $no=$no+1;?>.</td>
        <td><?php echo $data['judul']; ?></td>
        <td><?php echo $data['link']; ?></td>
        <td><a href="index.php?modul=ebookdel&id=<?php echo $data['id'] ?>"onClick="return confirm('apakah yakin ingin menghapus dengan Id : <?php echo $data['id']?>')"><img src="images/ico_del.gif" alt="del" class="ico" title="Delete" border="0" /></a></td>
      </tr>
      <?php
	}
	?>
    </tbody>
  </table>
</form>
</body>
</head>
</html>
