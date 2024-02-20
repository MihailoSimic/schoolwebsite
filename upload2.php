<?php

if(isset($_POST["submit"])) {
    
    if(isset($_FILES["imageFile2"]) && $_FILES["imageFile2"]["error"] === UPLOAD_ERR_OK) {
        session_start();
        $targetDir = "slike/"; 
        $imageName = $_POST["username"];
        $imageFileType = strtolower(pathinfo($_FILES["imageFile2"]["name"], PATHINFO_EXTENSION));
        $targetFile = $targetDir . $imageName . '.' . $imageFileType;

        if($imageFileType != "png" && $imageFileType != "jpg") {
            
            exit;
        }


        if(file_exists($targetFile)) {
            
            exit;
        }

        if(move_uploaded_file($_FILES["imageFile2"]["tmp_name"], $targetFile)) {
            
        } else {
            
        }
    } else {
        
    }
}
require 'veza.php';
$username = $_POST["username"];
$sql22="SELECT* FROM ucenici WHERE username = '$username'";
$result22=mysqli_query($conn,$sql22);
$sql24="SELECT * FROM nastavnici WHERE username = '$username'";
$result24=mysqli_query($conn,$sql24);


$mejl=$_POST["email"];
    $sql33="SELECT* FROM ucenici WHERE mejl = '$mejl'";
    $result33=mysqli_query($conn,$sql33);
    $sql34="SELECT* FROM nastavnici WHERE mejl = '$mejl'";
    $result34=mysqli_query($conn,$sql34);
if(mysqli_num_rows($result22)>0 || mysqli_num_rows($result24)>0){
    echo "Korisnicko ime je zauzeto.";
}
else if(mysqli_num_rows($result33)>0|| mysqli_num_rows($result34)>0){
    echo "Email adresa je zauzeta.";
}
else{
    $password = $_POST["password"];
	$ime=$_POST["ime"];
	$prezime=$_POST["prezime"];
	$pol=$_POST["pol"];
	$mejl=$_POST["email"];
	$telefon=$_POST["telefon"];
	$potvrdjen=false;
 

	session_start();
	$_SESSION['username']=$username;
	$_SESSION['password']=$password;
	$_SESSION['ime']=$ime;
	$_SESSION['prezime']=$prezime;
	$_SESSION['pol']=$pol;
	$_SESSION['telefon']=$telefon;
	$_SESSION['mejl']=$mejl;
	$_SESSION['potvrdjen']=$potvrdjen;
	$_SESSION['tip']="nastavnik";
    header('Location: nastavnikforma2.php');
}