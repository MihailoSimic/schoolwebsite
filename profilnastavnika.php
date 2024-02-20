
<?php
require 'veza.php';
session_start();
$username=$_SESSION['username'];
$sql="SELECT* FROM ucenici WHERE username='$username'";

$result=mysqli_query($conn,$sql);
?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="stilovi.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
    <center>
        <h4>Nastavnicki profil </h4>

        <?php
if(isset($_SESSION['username'])) {
    $imageName = $_SESSION['username'];
    $imagePath = 'slike/' . $imageName; 
    $allowedExtensions = array('png', 'jpg');
    $imagePath2="";
    
    foreach ($allowedExtensions as $extension) {
        if(file_exists($imagePath . '.' . $extension)) {
            
            $imagePath2=$imagePath.$extension;
            echo "<img src='$imagePath.$extension' alt='$imageName' width='150' height='150'>";
            break;
        }
    }
    if($imagePath2==""){
        echo "<img src='slike/default.png' alt='default' width='150' height='150'>";
    }
    
}

?>
        <table>
            <tr>
                <td style="padding-right:10px">Korisnicko ime:</td>
                <td style="padding-right:40px">
                    <?php  
                    $username=$_SESSION['username'];
                    $sql="SELECT* FROM nastavnici WHERE username='$username'";
                    $result=mysqli_query($conn,$sql);
                    $row = mysqli_fetch_assoc($result);
                    echo (string) $row['username'];
                    ?>
                </td>
                <td style="padding-right:10px">Mejl:</td>
                <td><?php  
                    echo (string) $row['mejl'];
                    ?></td>
            </tr>
            <tr>
                <td>Ime:</td>
                <td>
                <?php  
                    echo (string) $row['ime'];
                    ?></td>


                </td>
                <td>Prezime:</td>
                <td>
                <?php  
                    echo (string) $row['prezime'];
                    ?></td>
                </td>
            </tr>
            <tr>
                <td>Razred:</td>
                <td>
                <?php  
                    echo (string) $row['razred'];
                    ?></td>

                </td>
                <td>Telefon:</td>
                <td>
                <?php  
                    echo (string) $row['telefon'];
                    ?></td>
                </td>
            </tr>
            <tr>
                <td></td><td></td><td></td>
                <form action="izmenaprofila.php">
                <td><input type="submit" value="Azuriraj podatke" ><td>
                </form>
            </tr>
        </table>
        <table>
            <th>Predmeti</th>
            <?php
            
                $sql2="SELECT* FROM predmeti WHERE username='$username'";
                $result2 = mysqli_query($conn, $sql2); 
                if ($result2) {
                    if (mysqli_num_rows($result2) > 0) {
                        while ($row2 = mysqli_fetch_assoc($result2)) {
        
                            echo "<tr>
                                    <td>" . $row2['naziv'] . "</td>
                                    
                                  </tr>";
                        }
                
                        echo "</table>";
                    } else {
                        echo "Nema izabranih predmeta.";
                        echo "</table>";
                    }
                } else {
                    echo "Error: " . mysqli_error($conn);
                    echo "</table>";
                }
                ?>
        </table>

    </center>
</body>
</html>