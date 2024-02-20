<html>
<head>

</head>

<body>
<center>
<h2>Održani ćasovi</h2>
<table border="1">
<tr>
<th>Predmet</th>
<th>Nastavnik</th>
<th>Početak časa</th>
<th>Kraj časa</th>
<th>Komentar</th>
<th> Oceni</th>
</tr>
<?php
require 'veza.php';
session_start();
$user=$_SESSION['username'];
$sql = "SELECT * FROM casovi WHERE odrzan=1 AND ucenik='$user' ORDER BY pocetak ASC"; 
$osvezi="UPDATE casovi SET odrzan=1 WHERE kraj<NOW() AND prihvacen=1";
$result22=mysqli_query($conn, $osvezi);
$result = mysqli_query($conn, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row['naziv'] . "</td>
                    <td>" . $row['nastavnik'] . "</td>
                    <td>" . $row['pocetak'] . "</td>
                    <td>" . $row['kraj'] . "</td>
                    <td>" . $row['komentarnastavnik'] . "</td>
                  ";
                  if($row['ocenanastavnik']==0){
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
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
</table>
<h2>Naredni časovi</h2>
<table border="1">
<tr>
<th>Predmet</th>
<th>Nastavnik</th>
<th>Početak časa</th>
<th>Kraj časa</th>
<th>Tema</th>
<th>Komentar</th>
<th>Link</th>
<th></th>
</tr>
<?php
$sql = "SELECT * FROM casovi WHERE odrzan=0 AND ucenik='$user' ORDER BY pocetak ASC"; 
$result = mysqli_query($conn, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $simbol="x";
            if($row['prihvacen']==0){
                $simbol="?";
            }
            else if($row['prihvacen']==1){
                $simbol="✓";
            }
           if($simbol=="x"){
            echo "<tr style='color:red'>";
           }
           else{
            echo "<tr>";
           }
            echo "
                    <td>" . $row['naziv'] . "</td>
                    <td>" . $row['nastavnik'] . "</td>
                    <td>" . $row['pocetak'] . "</td>
                    <td>" . $row['kraj'] . "</td>
                    <td>" . $row['porukaucenik'] . "</td>
                    <td>" . $row['porukanastavnik'] . "</td>
                    <td>" . $row['link'] . "</td>
                    <td>" . $simbol. "</td>
                  </tr>";
        }

    } 
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
</table>
</center>
</body>

</html>