<?php
$kor=$_POST['dugme'];
require 'veza.php';
$sql = "UPDATE `nastavnici` SET `potvrdjen`='0', `odbijen`='1' WHERE username='$kor'";
$result=mysqli_query($conn,$sql);
header("Location: admin.php");

?>