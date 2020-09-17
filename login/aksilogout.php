<?php
session_start();
unset($_SESSION['userpus']);
session_destroy();
header("Location: ../index.php");
?>