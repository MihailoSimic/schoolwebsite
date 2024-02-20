<?php
$brojac=0;

if(isset($_POST["submit"])) {
    
    if(isset($_FILES["pdfFile"])&& $_FILES["pdfFile"]["error"] === UPLOAD_ERR_OK) {
        session_start();
        $x=$_SESSION['username'];
        $targetDir = "biografije/"; 
        $targetFile = $targetDir . $x.'.pdf'; 

        
        
        if(file_exists($targetFile)) {
            
            exit;
        }

        
        if(move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $targetFile)) {
            
        } else {
            
        }
    
    
$mladji=isset($_POST["mladji"]);
$stariji=isset($_POST["stariji"]);
$razred="niko";


$user=$_SESSION["username"];

require 'veza.php';
$selectQuery = "SELECT * FROM predmeti WHERE username=''" ; 
$result = mysqli_query($conn, $selectQuery);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        
        if (isset($row['naziv'])) {
            $name = $row['naziv'];
            
            if(isset($_POST[$name])){
                if($name!='Nesto_drugo'){
                    $sql="INSERT INTO `predmeti` (`naziv`, `username`) VALUES ('$name', '$user')";
                    $result2=mysqli_query($conn,$sql);
                }
                else{

                $brojac++;
                }
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
$hashedpassword=md5($password);
$ime=$_SESSION["ime"];
$prezime=$_SESSION["prezime"];
$pol=$_SESSION["pol"];
$mejl=$_SESSION["mejl"];
$telefon=$_SESSION["telefon"];
$potvrdjen=false;
$odbijen=-1;

$sql = "INSERT INTO nastavnici (username, password,ime,prezime,pol,telefon,mejl,potvrdjen,odbijen) VALUES ('$username', '$hashedpassword','$ime','$prezime','$pol','$telefon','$mejl','$potvrdjen','$odbijen')";
$result=mysqli_query($conn,$sql);
$sql="UPDATE nastavnici SET razred = '$razred' WHERE username = '$user'";
$result=mysqli_query($conn,$sql);
if($brojac>0){
    header('Location: uploady.php');
}
else{


?>
    <script>
    window.parent.location.reload();
    </script>
    
<?php   
} 
    }
    else {
        echo "Niste uneli CV.";
    }
}

