<?php
	$konekcija = mysqli_connect("localhost","root",
							"123","mojagalerija");

	$ime = basename($_FILES['mojfajl']['name']);
	$ekstenzija = $_FILES['mojfajl']['type'];
	$temp = $_FILES['mojfajl']['tmp_name'];
	
	$fleg = true;
	$tipovi = array('image/jpeg', 'image/png', 
		'image/gif','application/pdf');
	if(!in_array($ekstenzija, $tipovi)){
		echo "Nije podrzan fajl za upload!";
		$fleg = false;
	}
	
	$putanja = "slike/".$ime;
	
	list($sirina, $visina, $tip) = getimagesize($temp);
	$velicina = filesize($temp); 
	echo "Sirina slike: ".$sirina;
	echo "Visina slike: ".$visina;
	echo "Velicina: ".($velicina/1000)." KB";
	
	define("MAX_SIRINA", 600);
	define("MAX_VISINA", 400);
	define("MAX_VELICINA", 5000000);
	if($sirina > MAX_SIRINA || $visina > MAX_VISINA ||
		$velicina > MAX_VELICINA){
			$fleg = false;
	}
	
	$trenutak = date('Y-m-d H:i:s', time());
	$pozicija = $_POST['pozicija'];
	$link = $_POST['link'];
	
	if($link == "" || $link == "http://"){
		$link = "";
		echo "Niste uneli link ispod slike";
		$fleg = false;
	} else {
		$link = mysqli_real_escape_string($konekcija,
							stripslashes($_POST['link']));
	}
	
	if($fleg){
		if(move_uploaded_file($temp, $putanja)){
			
			$upit = "INSERT INTO fajlovi(trenutak,ime,link,pozicija)".
			" VALUES('".$trenutak.
					"', '".$ime."', '".$link."',".$pozicija.")";
			$rezultat = mysqli_query($konekcija, $upit)
						or die("Greska u upitu:".mysqli_error($konekcija));
			echo "Uspesan unos u bazu: ".$rezultat;
		} else {
			echo "Upload nije uspeo!";
		}
	}
?>
<br/>
<a href="galerija.php">Pregled slika</a>