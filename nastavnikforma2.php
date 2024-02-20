<?php

require 'veza.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
	
    $mladji=isset($_POST["mladji"]);
	$stariji=isset($_POST["stariji"]);
	$razred="niko";

	session_start();
	$user=$_SESSION["username"];


	$selectQuery = "SELECT * FROM predmeti WHERE username=''" ; 
	$result = mysqli_query($conn, $selectQuery);
	if ($result && mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			
			if (isset($row['naziv'])) {
				$name = $row['naziv'];
				if(isset($_POST[$name])){
					$sql="INSERT INTO `predmeti` (`naziv`, `username`) VALUES ('$name', '$user')";
					$result2=mysqli_query($conn,$sql);
				}
			
		   
		}
	}
}
	if($mladji && $stariji){$razred="1-8";
	}else if($mladji){$razred="1-4";
	}else if($stariji){$razred="5-8";
	}
	$username = $_SESSION["username"];
    $password = $_SESSION["password"];
	$ime=$_SESSION["ime"];
	$prezime=$_SESSION["prezime"];
	$pol=$_SESSION["pol"];
	$mejl=$_SESSION["mejl"];
	$telefon=$_SESSION["telefon"];
	$potvrdjen=false;
	$odbijen=-1;

	$sql = "INSERT INTO nastavnici (username, password,ime,prezime,pol,telefon,mejl,potvrdjen,odbijen) VALUES ('$username', '$password','$ime','$prezime','$pol','$telefon','$mejl','$potvrdjen','$odbijen')";
	$result=mysqli_query($conn,$sql);
	$sql="UPDATE nastavnici SET razred = '$razred' WHERE username = '$user'";
	$result=mysqli_query($conn,$sql);
	?>
        <script>
        window.parent.location.reload();
        </script>
        <?php
    //header('Location: profilnastavnika.php');
}
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="stilovi.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<title>Nastavnik forma 2  </title>

</head>

<body>
	<form name="forma" method="post" action="upload3.php" enctype="multipart/form-data">
<div class="container-fluid">
	<div class="row naslov">
		<center>Odgovorite na sledeca pitanja:</center>
	</div>
	<div class="row razmak">
	</div>
	<div class="row">
	
	<center>
	<table>
	<tr>
	<td>
	Koje predmete zelite da poducavate?
	</td>
	<td>
	<?php
	
$selectQuery = "SELECT * FROM predmeti"; 
$result = mysqli_query($conn, $selectQuery);


if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
       
        if (isset($row['naziv'])) {
			if($row['naziv']!='Nesto_drugo'){

			
			$name = $row['naziv'];
			$username=$row['username'];
			
				if($username=="")echo "<input type='checkbox' name='$name' value='$name'>$name<br>";
			}
       
    }
}
} else {
    echo "No data found.";
}
echo "<input type='checkbox' name='Nesto_drugo' value='Nesto_drugo'>Nešto drugo<br>";

	?>
	
	
	</td>
	</tr>
	
	<tr>
	
	<td>
	Kom uzrastu zelite da predajete?
	</td>
	
	<td>
	<input type="checkbox" name="mladji" value="mladji">1.-4. razred <input type="checkbox" name="stariji" value="stariji">5.-8. razred
	</td>
	</tr>
	
	<tr>
	
	<td>
	Prilozite vas CV
	</td>
	
	<td>
	<input type="file" id="pdfFile" name="pdfFile" accept=".pdf" onchange="proverifajl(this)"></input>
	</td>
	</tr>
	<tr>
		<td><input type="submit" value="Registruj se"  name="submit"> </td>
		

		</tr>
	</table>
	</center>
	
	
	</div>
</div>
</form>
</body>
<script>
  function proverifajl(input) {
    if (input.files && input.files[0]) {
      var fileSize = input.files[0].size; 
      var maxSize = 3*1024*1024;

      if (fileSize > maxSize) {
        alert("Fajl ne sme biti veci od 3MB.");
        input.value = '';
      }
    }
  }
</script>

</html>