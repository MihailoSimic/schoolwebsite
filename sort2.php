<?php
echo 'kliknut'; 
$actionNumber=$_GET['action'];
echo $actionNumber;
session_start();
$_SESSION['sort']=$actionNumber;
header('Location:prikaznastavnika.php');
?>