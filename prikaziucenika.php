<html>
<head>

</head>

<body>
<center>
<?php
    session_start();
    require 'veza.php';

    $ucenik=$_GET['id'];
    $sql2="SELECT* FROM ucenici WHERE username='$ucenik'";
    $result2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_assoc($result2);
    echo "<h2>". $row2['ime']." ".$row2['prezime']."</h2>"
?>
<table border="1">
    <tr>
        <th>Predmet</th>
        <th>Pocetak</th>
        <th>Kraj</th>
        <th>Oceni</th>
    </tr>
<?php
$nastavnik=$_SESSION['username'];
$sql="SELECT* FROM casovi WHERE nastavnik='$nastavnik' AND ucenik='$ucenik' AND odrzan=1
ORDER BY naziv ASC, pocetak ASC
";
$result=mysqli_query($conn,$sql);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        
        while ($row = mysqli_fetch_assoc($result)) {
            
            echo "<tr>
                    <td>" . $row['naziv'] . "</td>
                    <td>" . $row['pocetak'] . "</td>
                    <td>" . $row['kraj'] . "</td>";
                    if($row['ocenaucenik']==0){
                        ?>
                    <td>
                    <form method='post' action='dodajocenu.php'>
                    <input type='submit' value='Dodaj ocenu'>
                    <input type='hidden' name='idC' value='<?php echo $row['idC'] ?>'>
                    
                    </form>
                    </td>
                    
                    
                    <?php
                    }
                    
            echo "</tr>";
                  
        }

    } 
} 
?>
</table>
</center>
</body>

</html>