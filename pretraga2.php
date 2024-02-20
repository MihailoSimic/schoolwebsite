<?php
$param=$_POST['parametar'];
$pretraga=$_POST['pretraga'];

echo $param;
echo $pretraga;
session_start();

$_SESSION['param2']=$param;
$_SESSION['pretraga2']=$pretraga;
header("Location: prikaznastavnika.php");
?>