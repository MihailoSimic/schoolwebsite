<html>
<head>

</head>

<body>
<center>
<h2> Moji učenici </h2>
<table border="1">
    <tr>
        <th>Ime</th>
        <th>Prezime</th>
        <th>Dosije</th>
    </tr>
<?php
    require 'veza.php';
    session_start();
    $osvezi="UPDATE casovi SET odrzan=1 WHERE kraj<NOW()";
    $result22=mysqli_query($conn, $osvezi);
    $user=$_SESSION['username'];
    $sql = "SELECT DISTINCT ucenik FROM casovi WHERE odrzan=1 AND nastavnik='$user'"; 
    $result = mysqli_query($conn, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        
        while ($row = mysqli_fetch_assoc($result)) {
            $ucenik=$row['ucenik'];
            $sql2="SELECT* FROM ucenici WHERE username='$ucenik'";
            $result2=mysqli_query($conn,$sql2);
            $row2=mysqli_fetch_assoc($result2);
            echo "<tr>
                    <td>" . $row2['ime'] . "</td>
                    <td>" . $row2['prezime'] . "</td>
                    <td><a href='prikaziucenika.php?id=$ucenik'>link</a></td>
                
                  </tr>";
                  
        }

    } 
} 
?>
</table>

</center>
</body>

</html>