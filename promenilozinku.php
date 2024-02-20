<?php
    require 'veza.php';
    $username=$_POST['korisnicko'];
    $nova=$_POST['nova'];
    $nova2=$_POST['nova2'];
    $stara=$_POST['stara'];
    if($nova==$nova2){
        $sql="UPDATE nastavnici SET password='$nova' WHERE username='$username' AND password='$stara'";
        $result=mysqli_query($conn,$sql);
        $redovi= mysqli_affected_rows($conn);
        if($redovi==0){
            $sql="UPDATE ucenici SET password='$nova' WHERE username='$username' AND password='$stara'";
            $result=mysqli_query($conn,$sql);
            $redovi= mysqli_affected_rows($conn);
        }
        if($redovi==0){
            echo "Pogresno uneto korisnicko ime ili lozinka";
        }
        else{
            echo "Lozinka promenjena";
        }
    }
    else{
        echo "Losa potvrda lozinke";
    }
    
?>