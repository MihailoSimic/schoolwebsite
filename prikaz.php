<?php
echo 'kliknut'; 
$actionNumber=$_GET['action'];
echo $actionNumber;
session_start();
$_SESSION['limit']=$actionNumber;
header('Location:casovinastavnik.php');
?>