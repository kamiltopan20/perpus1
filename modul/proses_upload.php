
<?php
include_once 'include/koneksi.php';

if(isset($_POST['SAVE'])){
	$direktori ="./ebook/";
	$max_size = 1000000000*10; 
	$nama_file = $_FILES['file']['name'];
	$file_size = $_FILES['file']['size'];
	$nama_temp = $_FILES['file']['tmp_name'];
	$upload = $direktori . $nama_file; 
	
	if($nama_file==""){ echo "File gagal Di upload anda tidak memilih file apapun !";}
	else{
	if($file_size <=$max_size)
	{
		if(move_uploaded_file($nama_temp, $upload)){
		
		$judul = $_POST['judul'];
		$kode = $_POST['akses'];
		$query=mysql_query("INSERT INTO ebook(judul,link,kode) VALUES ('$judul','$nama_file','$kode')");
		echo "File Di upload ke file direktory:".$direktori.$nama_file."";}
		else { echo "file ".$nama_file."   Gagal Di upload, Karna berbagai macam alasan!";}
		}
	else
	{
	
	//jika ukuran file besar
	echo "file ".$nama_file."Gagal di Upload, karna terlalu besar, batas yang ditentukan adalah : ".$max_size." bait.";
	}}}
	else
	{
	echo "Harus melalui form upload sebelum ke halaman ini!";
	}
	?>
	<meta http-equiv="refresh" content=1;url='index.php?modul=inputebook' />