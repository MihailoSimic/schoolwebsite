<?php
$kor=$_POST['sakriven'];
echo $kor;
if (isset($_POST['btn2'])) {
    session_start();
    require 'veza.php';

        $staro=$kor;
        $usern=$_POST['username'];
        $mejl=$_POST['mejl'];
        $ime=$_POST['ime'];
        $prezime=$_POST["prezime"];
        $telefon=$_POST["telefon"];
        $razred=$_POST["razred"];
        
        
            $sql="UPDATE `nastavnici` SET `username`='$usern',`ime`='$ime',`prezime`='$prezime',`telefon`='$telefon',`mejl`='$mejl',`razred`='$razred' WHERE username='$staro'";
    
            //$_SESSION['username']=$usern;
        $result=mysqli_query($conn,$sql);
        header("Location: admin.php");
    }
?>