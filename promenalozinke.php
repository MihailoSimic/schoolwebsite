<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require 'veza.php';
    $username=$_POST['korisnicko'];
    $nova=$_POST['nova'];
    $nova2=$_POST['nova2'];
    $stara=$_POST['stara'];
    if($nova==$nova2){
        $hashstara=md5($stara);
        $hashnova=md5($nova2);
        $sql="UPDATE nastavnici SET password='$hashnova' WHERE username='$username' AND password='$hashstara'";
        $result=mysqli_query($conn,$sql);
        $redovi= mysqli_affected_rows($conn);
        if($redovi==0){
            $sql="UPDATE ucenici SET password='$hashnova' WHERE username='$username' AND password='$hashstara'";
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
    }
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="stilovi.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script>
function provera(){

let pas1=document.forma3.stara.value;
let pas2=document.forma3.nova.value;
let pas3=document.forma3.nova2.value;
let username=document.forma3.korisnicko.value;
let uzorak1=/^[A-Za-zČčĆćŠšĐđŽž]+$/;
let uzorak2=/^\+{0,1}\d{8,15}$/;
let uzorak3=/^\w{7,15}@\w{4,15}\.(com|rs)$/;
let uzorak4=/^(?=.*[A-Z])(?=.*[a-z].*[a-z].*[a-z])(?=.*\d)(?=.*[!@#$%^&*()-+=?]).{6,10}/
if(pas1=="" || pas2=="" || pas3=="" || username==""){
	alert("Popunite sva polja");
	return false;
}
else if(pas3!=pas2){
	alert("Losa potvrda lozinke");
	return false;
}
else if((!uzorak4.test(pas2))){
	alert("Lozinka 6-10 karaktera pocinje slovom, barem jedan broj i specijalni karakter");
	return false;
}
else{
	return true;
}
}

</script>
</head>
<body>
<center>
    <h4> Promena lozinke</h4>
    <form method="post" name="forma3" onsubmit="return provera()">
    
    
    <table>
        <tr>
            <td>Korisnicko ime:</td>
            <td><input type="text" name="korisnicko"></td>
        </tr>
        <tr>
            <td>Stara lozinka:</td>
            <td><input type="password" name="stara"></td>
        </tr>
        <tr>
            <td>Nova lozinka:</td>
            <td><input type="password" name="nova"></td>
        </tr>
        <tr>
            <td>Potvrda nove lozinke:</td>
            <td><input type="password" name="nova2"></td>
        </tr>
        <tr>
            <td><input type="submit" value="Promeni lozinku"></td>
            
        </tr>
    </table>
    
    </form>
    <center>
</body>
</html>