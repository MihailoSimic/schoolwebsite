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
	$razred=$_POST["razred"];
    
    $sql = "INSERT INTO ucenici (username, password,ime,prezime,pol,telefon,mejl,razred) VALUES ('$username', '$password','$ime','$prezime','$pol','$telefon','$mejl','$razred')";
	$result=mysqli_query($conn,$sql);
	session_start();
	$_SESSION['username']=$username;
	$_SESSION['tip']="ucenik";
	$_SESSION['x']="prijava";
	?>	
		<script>
        window.parent.location.reload();
        </script>
        <?php
    //header('Location: profilucenika.php');
}


$conn->close();
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="stilovi.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
let uzorak3=/^\w{7,15}@\w{4,15}\.(com|rs)$/;
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
}else{
	return true;
}
}

</script>
</head>
<body>

<div class="container-fluid">
	<div class="row naslov">
		<center>Registracija učenika </center>
	</div>
	<div class="row">
	<form name="forma1" method="post" onsubmit="return provera()" action="upload.php" enctype="multipart/form-data">
		<center>
            <table>
		<tr>
		<td>
		Korisničko ime:
		</td>
		
		<td>
		<input type="text" id="username" name="username"> </input>
		</td>
		</tr>
		
		<tr>
		<td>
		Lozinka:
		</td>
		
		<td>
		<input type="password" id="password" name="password"> </input>
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
		<input type="file" id="imageFile" name="imageFile" accept=".png, .jpg" onchange="proverisliku(this)" ></input>
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
          input.value = ''; // Reset the file input
        }
      };
    };

    reader.readAsDataURL(input.files[0]);
  }
}
</script>
		<tr>
		<td>
		Razred:
		</td>
		
		<td>
		<select name="razred">
		<option value="1"> 1.&nbsp&nbsp  </option>
		<option value="2"> 2.&nbsp&nbsp  </option>
		<option value="3"> 3.&nbsp&nbsp  </option>
		<option value="4"> 4.&nbsp&nbsp  </option>
		<option value="5"> 5.&nbsp&nbsp  </option>
		<option value="6"> 6.&nbsp&nbsp </option>
		<option value="7"> 7.&nbsp&nbsp  </option>
		<option value="8"> 8.&nbsp&nbsp  </option>
		</select>
		</td>
		</tr>
		<tr>
		<td><input type="submit" value="Registruj se" name="submit"> </td>
		

		</tr>
		
		</center></table>
		</form>
	</div>
</div>
</body>


</html>
