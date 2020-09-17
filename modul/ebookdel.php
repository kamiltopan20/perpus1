<?php

if($_GET['id']){
	$query = mysql_query("DELETE FROM ebook WHERE id = '".$_GET['id']."'");
	echo "<meta http-equiv='refresh' content=1;url='index.php?modul=inputebook' />";
}
	
	?>