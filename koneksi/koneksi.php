<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$server   ="localhost" ;
$username ="root";
$password ="";
$database   ="perpus1";
$con=@mysql_connect("localhost","root","")or die ("Server Tidak Ditemukan");
$db=@mysql_select_db("perpus") or mysql_query("CREATE DATABASE perpus",$con);
?>