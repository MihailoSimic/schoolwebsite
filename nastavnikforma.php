<?php
require 'veza.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST["username"];
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

$conn->close();
?>



<html>
<head>
<link rel="stylesheet" type="text/css" href="stilovi.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<title>Nastavnik forma 1 </title>
<script>
function provera(){
let ime=document.forma1.ime.value;
let prezime=document.forma1.prezime.value;
let pas1=document.forma1.password.value;
let pas2=document.forma1.password2.value;
let email=document.forma1.email.value;
let username=document.forma1.username.value;
let tel=document.forma1.telefon.value;
let uzorak1=/^[A-Za-zČčĆćŠšĐđŽž]+$/;
let uzorak2=/^\+{0,1}\d{8,15}$/;
let uzorak3=/^\w{5,15}@\w{4,15}\.(com|rs)$/;
let uzorak4=/^(?=.*[A-Z])(?=.*[a-z].*[a-z].*[a-z])(?=.*\d)(?=.*[!@#$%^&*()-+=?]).{6,10}/
if(ime=="" || prezime=="" || pas1=="" || pas2=="" || email=="" || username=="" || tel==""){
	alert("Popunite sva polja");
	return false;
}
else if(pas1!=pas2){
	alert("Losa potvrda lozinke");
	return false;
}
else if((!uzorak1.test(ime))||(!uzorak1.test(prezime))){
	alert("Lose uneto ime ili prezime");
	return false;
}
else if(!uzorak2.test(tel)){

alert("Lose unet broj telefona");
	return false;
}
else if(!uzorak3.test(email)){
	alert("Lose unet email");
	return false;
}else if(!uzorak4.test(pas1)){
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

<div class="container-fluid">
	<div class="row naslov">
		<center>Registracija nastavnika </center>
	</div>
	<div class="row">
	<form name="forma1" method="post" onsubmit="return provera()" action="upload2.php" enctype="multipart/form-data">
		<center><table>
		<tr>
		<td>
		Korisničko ime:
		</td>
		
		<td>
		<input type="text" name="username"> </input>
		</td>
		</tr>
		
		<tr>
		<td>
		Lozinka:
		</td>
		
		<td>
		<input type="password" name="password"> </input>
		</td>
		</tr>
		
		<tr>
		<td>
		Potvrdi lozinku:
		</td>
		
		<td>
		<input type="password" name="password2"> </input>
		</td>
		</tr>
		
		<tr>
		<td>
		Ime:
		</td>
		
		<td>
		<input type="text" name="ime"> </input>
		</td>
		</tr>
		
		<tr>
		<td>
		Prezime:
		</td>
		
		<td>
		<input type="text" name="prezime"> </input>
		</td>
		</tr>
		
		<tr>
		<td>
		Pol:
		</td>
		
		<td>
		<input type="radio" name="pol" value="M" checked> M </input>
		</td>
		</tr>
		
		<tr>
		<td></td>
		<td>
		<input type="radio" name="pol" value="Z"> Ž</input>
		</td>
		</tr>
		
		<tr>
		<td>
		Kontakt telefon:
		</td>
		
		<td>
		<input type="text" name="telefon"> </input>
		</td>
		</tr>
		
		<tr>
		<td>
		E-mail:
		</td>
		
		<td>
		<input type="text" name="email"> </input>
		</td>
		</tr>
		
		<tr>
		<td>
		Slika:
		</td>
		
		<td>
		<input type="file" id="imageFile2" name="imageFile2" accept=".png, .jpg" onchange="proverisliku(this)" ></input>
		</td>
		</tr>
<script>
function proverisliku(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      var image = new Image();
      image.src = e.target.result;

      image.onload = function() {
        var width = this.width;
        var height = this.height;

        if (width < 100 || height < 100 || width > 300 || height > 300) {
          alert("Image dimensions must be between 100x100 and 300x300 pixels.");
          input.value = ''; 
      };
    };

    reader.readAsDataURL(input.files[0]);
  }
}
</script>
		
		<tr>
		<td><input type="submit" value="Registruj se" name="submit" > </td>
		

		</tr>
		
		</center></table>
		</form>
	</div>
</div>
</body>

</html>