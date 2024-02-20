<html>
    <body>
<form method='post' action='logoutadmin.php'>
    <input type="submit" value="Izloguj se">
</form>
<script>
    document.getElementById("pdfForm").addEventListener("submit", function(event) {
    event.preventDefault(); 
    
    var pdfName = document.getElementById("pdfName").value;
    
    
    var url = "biografije/" + pdfName + ".pdf"; 
    window.open(url, "_blank");
});
</script>
<?php
require 'veza.php';
echo '<h1>Nastavnici</h1>';
$sql = "SELECT * FROM nastavnici WHERE potvrdjen=1"; 
$result = mysqli_query($conn, $sql);

if ($result) {
    $br=0;
    if (mysqli_num_rows($result) > 0) {
        echo "<form method='post' action='promeni.php'>";
        echo "<table border='1'>
                <tr>
                    <th>Korisnicko ime</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Pol</th>
                    <th>Telefon</th>
                    <th>Mejl</th>
                    <th>Razred</th>
                    <th>Azuriraj</th>
                    <th>Deaktiviraj</th>
                    <th>CV</th>
                </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['ime'] . "</td>
                    <td>" . $row['prezime'] . "</td>
                    <td>" . $row['pol'] . "</td>
                    <td>" . $row['telefon'] . "</td>
                    <td>" . $row['mejl'] . "</td>
                    <td>" . $row['razred'] . "</td>
                    
                  ";
                  ?>
                  <form method='post' action='azurirajprof.php'>
                    <td> <input type='submit' value='Azuriraj'></td>
                    <input type='hidden' name='dugme' value='<?php echo $row['username'] ?>'>
                    </form>

                    <form method='post' action='deaktivirajprof.php'>
                    <td> <input type='submit' value='Deaktiviraj'></td>
                    <input type='hidden' name='dugme' value='<?php echo $row['username'] ?>'>
                    </form>
                    <form id="pdfForm" method='post' action='uploadx.php'>
                    <td>
                    <input type="hidden" id="pdfName" name="pdfName" value="<?php echo $row['username']?>">
                    <input type="submit" value="CV">
                    
                    </td>
                    </form>
                    
        </tr>
                   <?php 
                  $br++;
        }

        
        echo "</table>";
        echo "</form>";
    } else {
        echo "Nema aktivnih nastavnika.";
    }
} else {
    echo "Error: " . mysqli_error($conn);
}
echo '<h1>Ucenici</h1>';
$sql = "SELECT * FROM ucenici"; 
$result = mysqli_query($conn, $sql);
if ($result) {
    $br=0;
    if (mysqli_num_rows($result) > 0) {
        echo "<form method='post' action='promeni.php'>";
        echo "<table border='1'>
                <tr>
                    <th>Korisnicko ime ID</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Pol</th>
                    <th>Telefon</th>
                    <th>Mejl</th>
                    <th>Razred</th>
                </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['ime'] . "</td>
                    <td>" . $row['prezime'] . "</td>
                    <td>" . $row['pol'] . "</td>
                    <td>" . $row['telefon'] . "</td>
                    <td>" . $row['mejl'] . "</td>
                    <td>" . $row['razred'] . "</td>
                  </tr>";
                  $br++;
        }

        
        echo "</table>";
        echo "</form>";
    } else {
        echo "No users found in the table.";
    }
} else {
    echo "Error: " . mysqli_error($conn);
}
echo '<h1>Zahtevi</h1>';
$sql = "SELECT * FROM nastavnici WHERE odbijen=-1";
$result = mysqli_query($conn, $sql);

if ($result) {
    $br=0;
    if (mysqli_num_rows($result) > 0) {
        echo "<form method='post' action='promeni.php'>";
        echo "<table border='1'>
                <tr>
                    <th>Korisnicko ime ID</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Pol</th>
                    <th>Telefon</th>
                    <th>Mejl</th>
                    <th>Razred</th>
                    <th>Potvrdi</th>
                    <th>Odbij</th>
                    <th>CV</th>
                    
                </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['ime'] . "</td>
                    <td>" . $row['prezime'] . "</td>
                    <td>" . $row['pol'] . "</td>
                    <td>" . $row['telefon'] . "</td>
                    <td>" . $row['mejl'] . "</td>
                    <td>" . $row['razred'] . "</td>
                    
                    <td>
                    <input type='hidden' name='" . $br . "a' value='" . $row['username'] . "'>
                    <input type='hidden' name='max' value='" . $br . "'>
                    <input type='submit' name='" . $br . "' style='height:20px;width:150px' value='Potvrdi')> </td>
                    <td>
                
                    <input type='submit' name='" . $br . "' style='height:20px;width:150px' value='Odbij')> </td>
                    
                  ";
                  $br++;
                  
                ?>
            
                <form  method='post' action='uploadx.php'>
                    <td>
                    <input type="hidden" name="pdfName" value="<?php echo $row['username']?>">
                    <input type="submit" value="CV">  
                    </td>
                </form>
        </tr>
                  <?php
                  
                
        }

       
        echo "</table>";
        echo "</form>";
    } else {
        echo "Nema neobradjenih zahteva.";
    }
} else {
    echo "Error: " . mysqli_error($conn);
}
mysqli_close($conn);
?>
<h2>Dodavanje predmeta</h2>
<form method='post'>
    <table>
        <tr>
            <td>Uneti novi predmet:</td>
            <td><input type="text" name="novipredmet"> </td>
        </tr>
        <tr>
            <td><input type="submit" value="Potvrdi" name="btn"></td>
        </tr>
    </table>
</form>

<?php
    if(isset($_POST['btn'])){
        require 'veza.php';
        $novi=$_POST['novipredmet'];
        echo $novi;
        $sql = "INSERT INTO `predmeti`(`naziv`, `username`) VALUES ('$novi','')";
        $result=mysqli_query($conn,$sql);
    }
?>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</body>
</html>
