<?php
	echo "<html>
	<head>
		<title>Barcode</title>
		
<style>
#tabel
{
font-size:15px;
border-collapse:collapse;
}
#tabel  td
{
padding-left:5px;
border: 1px solid black;
}
</style>
	</head>
	<body>
	<table id='tabel'><tr><td>
	<image src='barcode.php?codetype=Code128&size=60&text=$_GET[text]'/></td></tr>
	<tr><td><center>$_GET[text]</center></td></tr>
	</table>
	</body>
	</html>";
?>