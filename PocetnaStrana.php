<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="stilovi.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<title> Glavna </title>
</head>


<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-12 slika1">
		</div>
	</div>
	
	<div class="row">
		<div class="col-12 header">
		<h3> Moj najdraži nastavnik </h3>
		</div>
	</div>
	
	<div class="row">
		<div class="col-3 meni">
		<ul>
				<?php
				session_start();
				if(isset($_SESSION['username'])==false){
					echo '<li><a href="prijava.php" target="mojfrejm">Prijava</a></li>';
					echo '<li>
                    	<a href="ucenikforma.php" target="mojfrejm">Registracija ucenika</a>
                		</li>';
				echo '<li>
						<a href="nastavnikforma.php" target="mojfrejm">Registracija nastavnika</a>
					</li>';
				}
				?>
                
				<li>
                    <a href="glavna.php" target="mojfrejm">Glavna stranica</a>
					
                </li>
				
				<?php
				
				if(!isset($_SESSION['username'])){
					echo '<li><a href="promenalozinke2.php" target="mojfrejm">Zaboravili ste lozinku?</a></li>';
					
				}
				if(isset($_SESSION['username'])){
					echo '<li><a href="profil.php" target="mojfrejm">Profil</a></li>';
					
				}
				if(isset($_SESSION['tip'])){
					if($_SESSION['tip']=='ucenik'){
						echo '<li><a href="prikaznastavnika.php" target="mojfrejm">Nastavnici</a></li>';
						echo '<li><a href="casoviucenik.php" target="mojfrejm">Časovi</a></li>';
					}
					else if($_SESSION['tip']=='nastavnik'){
						echo '<li><a href="casovinastavnik.php" target="mojfrejm">Časovi</a></li>';
						echo '<li><a href="mojiucenici.php" target="mojfrejm">Moji učenici</a></li>';

                    }
				}
				if(isset($_SESSION['username'])){
					echo '<li><a href="promenalozinke.php" target="mojfrejm">Promena lozinke</a></li>';
					echo '<li><a href="izlogujse.php" target="mojfrejm">Izloguj se</a></li>';
				}
				?>
            </ul>
		</div>
		<div class="col-9 frejm">
			<iframe name="mojfrejm" height="100%" width="100%" src="prijava2.php"> </iframe>
		</div>
	</div>
	<div class="row">
		<div class="col-12 footer">
			Copyright 2024
		</div>
	
	</div>
	</div>
</div>

</body>



</html>