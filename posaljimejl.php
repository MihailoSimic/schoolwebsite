<?php

$name = $_POST['korisnicko'];

require 'veza.php';
$brojac=0;
$sql="SELECT * FROM nastavnici WHERE username='$name'";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)==0){
    $sql2="SELECT * FROM ucenici WHERE username='$name'";
    $result2=mysqli_query($conn,$sql2);
    
if(mysqli_num_rows($result2)==0){
    echo "Uneli ste nepostojeće korisničko ime.";
    $brojac=2;
}
else{
    $row=mysqli_fetch_assoc($result2);
    $email=$row['mejl'];
    $brojac=1;
}
}
else{
    $row=mysqli_fetch_assoc($result);
    $email=$row['mejl'];
}
//$email = $_POST["email"];
$subject = "Nova lozinka";
$broj = mt_rand(1000, 9999);
$novaloz="Aaaa".$broj."!";
$message ="Vasa nova lozinka je: 'Aaaa".$broj."!'";
$hashnova=md5($novaloz);

if($brojac==0){
    $sql4="UPDATE nastavnici SET password='$hashnova' WHERE username='$name'";
}else if($brojac==1){
    $sql4="UPDATE ucenici SET password='$hashnova' WHERE username='$name'";
}

$result=mysqli_query($conn,$sql4);
require "vendor/autoload.php";
//sbppbysfqsnutgcv
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = 'ssl';
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->Port = 465;

$mail->Username = "najjacipar47@gmail.com";
$mail->Password = "sbppbysfqsnutgcv";

$mail->setFrom($email, $name);
$mail->addAddress("simicmihailo@hotmail.com");

$mail->Subject = $subject;
$mail->Body = $message;

$mail->send();

echo "Uskoro ćete dobiti email sa vašom novom lozinkom.";