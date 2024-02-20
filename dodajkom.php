<?php
require 'veza.php';


$kom=$_POST['komentar'];
//echo $kom;

$idC=$_POST['idC'];
$sql="UPDATE casovi SET porukanastavnik='$kom' WHERE idC='$idC'";
$result=mysqli_query($conn,$sql);
header("location:casovinastavnik.php");
?>