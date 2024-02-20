<?php
$kor=$_POST['dugme'];

require 'veza.php';
?>
<form method='post' action='logoutadmin.php'>
    <input type="submit" value="Izloguj se">
</form>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="stilovi.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script>
        function provera(){
let razred=document.forma4.razred.value;
let ime=document.forma4.ime.value;
let prezime=document.forma4.prezime.value;
let username=document.forma4.username.value;
let tel=document.forma4.telefon.value;
let email=document.forma4.mejl.value;
if(ime=="" || prezime==""|| razred=="" || username==""|| tel==""|| email==""){
    alert("Popunite sva polja");
    return false;
}
else if(razred<1 || razred>8){
	alert("Lose unet razred");
	return false;
}else{
	return true;
}

    }
    </script>
</head>
    <center>
        <h4>Azuriranje </h4>
        <form name="forma4" method="post" action='izmena2.php' onsubmit="return provera()">
        <table>
            <tr>
                <td style="padding-right:10px">Korisnicko ime:</td>
                <td style="padding-right:40px">
                    <?php  
                    $username=$kor;
                    
                    $sql="SELECT* FROM nastavnici WHERE username='$username'";
                        
                    $result=mysqli_query($conn,$sql);
                    $row = mysqli_fetch_assoc($result);
                    $user=(string) $row['username'];
                    echo "<input type='text' value='$user' name='username'>";
                    ?>
                </td>
                <td style="padding-right:10px">Mejl:</td>
                <td><?php 
                     $user=(string) $row['mejl'];
                     echo "<input type='text' value='$user' name='mejl'>"; 
                    ?></td>
            </tr>
            <tr>
                <td>Ime:</td>
                <td>
                <?php  
                    $user=(string) $row['ime'];
                    echo "<input type='text' value='$user' name='ime'>"; 
                    ?></td>


                </td>
                <td>Prezime:</td>
                <td>
                <?php  
                    $user=(string) $row['prezime'];
                    echo "<input type='text' value='$user' name='prezime'>"; 
                    ?></td>
                </td>
            </tr>
            <tr>
                <td>Razred:</td>
                <td>
                <?php  
                    $user=(string) $row['razred'];
                    echo "<input type='text' value='$user' name='razred'>"; 
                    ?></td>

                </td>
                <td>Telefon:</td>
                <td>
                <?php  
                    $user=(string) $row['telefon'];
                    echo "<input type='text' value='$user'name='telefon'> "; 
                    ?></td>
                </td>
            </tr>
            <tr>
                <td></td><td></td><td></td>
                
                <td><input type="submit" value="Azuriraj" name='btn2' ><td>
                    <input type="hidden" name='sakriven' value='<?php echo $kor?>'>
                </form>
            </tr>
        </table>

    </center>

</html>
