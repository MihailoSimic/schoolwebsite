<?php
require 'veza.php';


$link=$_POST['link'];
echo $link;

$idC=$_POST['idC'];
$sql="UPDATE casovi SET link='$link' WHERE idC='$idC'";
$result=mysqli_query($conn,$sql);
header("location:casovinastavnik.php");
?>