<?php
$x=$_POST['idC'];
session_start();
if($_SESSION['tip']=='ucenik'){
        echo $x;
    
        require 'veza.php';
        $ocena=$_POST['ocenaucenik'];
        $kom=$_POST['komentarucenik'];
        $sql="UPDATE casovi SET ocenanastavnik='$ocena', komentarucenik='$kom' WHERE idC='$x'";
        $result=mysqli_query($conn,$sql);
header("Location:casoviucenik.php");
}
else{
        echo $x;
    
        require 'veza.php';
        $ocena=$_POST['ocenaucenik'];
        $kom=$_POST['komentarucenik'];
        $sql="UPDATE casovi SET ocenaucenik='$ocena', komentarnastavnik='$kom' WHERE idC='$x'";
        $result=mysqli_query($conn,$sql);
header("Location:mojiucenici.php");

}

    ?>