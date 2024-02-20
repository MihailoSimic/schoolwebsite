<?php
$param=$_POST['parametar'];
$pretraga=$_POST['pretraga'];

echo $param;
echo $pretraga;
session_start();

$_SESSION['param']=$param;
$_SESSION['pretraga']=$pretraga;
header("Location: glavna.php");
?>