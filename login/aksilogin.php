<?php
error_reporting(0);
//include "../koneksi/koneksi.php";
$login = mysql_query("select * from login where user = '" . $_POST['user'] . "' and password = '".md5($_POST['password'])."'",$con);
$login2 = mysql_query("select * from login where user = '" . $_POST['user'] . "' and password = '".md5($_POST['password'])."'",$con);
$rowcount = mysql_num_rows($login);
$rowcount2 = mysql_fetch_array($login2);
if ($rowcount == 1) {
$_SESSION['userpus'] = $_POST['user'];
$_SESSION['passwordpus'] = md5($_POST['password']);
$_SESSION['levelpus'] = $rowcount2['level'];
echo '<script>setTimeout(\'location.href="index.php"\' ,0);</script>';
}
else
{
switch ($_GET['aksi'])
{
//INTERFACE TABLE BROWSER
case "tampil";
echo '<html>
<head>
<link href="style/style.css" rel="stylesheet" type="text/css"/>
<title>LOGIN GAGAL !!!</title>
</head>
<body>
<center>';
echo "<img src=\"images/error.png\" width=\"100px\"/><h2>Login Gagal ..!!</h2>Cek user dan Password Anda..!!</br></br>
<form action='index.php?login' method='POST'><input type=\"submit\" value=\"Kembali\"></form>";
echo'
</center>	
</body>
</html>';
break;
}
}
?>