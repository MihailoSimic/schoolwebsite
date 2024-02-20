<html>
<head>
<script>
function redirectToPage(page, actionNumber) {
    // Redirect to the PHP page with the actionNumber as a query parameter
    window.location.href = page + '?action=' + actionNumber;
}
</script>
</head>

<body>
<center>
<h2>Naredni časovi</h2>
<table border="1">
<tr>
<th>Predmet</th>
<th>Ime</th>
<th>Prezime</th>
<th>Početak časa</th>
<th>Kraj časa</th>
<th>Link</th>
</tr>
<form method='post'>
<tr>
<td align="center" colspan=2><input type="button" value="Prikazi sve" onclick="redirectToPage('prikaz.php', 1000)"> </td>
<td align="center" colspan=2><input type="button" value="Prikazi 5" onclick="redirectToPage('prikaz.php', 5)"> </td>
<td align="center"colspan=2><input type="button" value="Prikazi 10" onclick="redirectToPage('prikaz.php', 10)"> </td>
</tr>
</form>
<?php
require 'veza.php';
session_start();
$osvezi="UPDATE casovi SET odrzan=1 WHERE kraj<NOW()";
$result22=mysqli_query($conn, $osvezi);
$user=$_SESSION['username'];
$sql = "SELECT * FROM casovi WHERE prihvacen=1 AND nastavnik='$user' AND odrzan=0 ORDER BY pocetak ASC";

if(isset($_SESSION['limit'])){
$limit=$_SESSION['limit'];
$sql .= " LIMIT $limit";
}

 
$result = mysqli_query($conn, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $korisnicko=$row['ucenik'];
            $sql22="SELECT* FROM ucenici WHERE username='$korisnicko'";
            $result22=mysqli_query($conn, $sql22);
            $row22=mysqli_fetch_assoc($result22);
            echo "<tr>
                    <td>" . $row['naziv'] . "</td>
                    <td>" . $row22['ime'] . "</td>
                    <td>" . $row22['prezime'] . "</td>
                    <td>" . $row['pocetak'] . "</td>
                    <td>" . $row['kraj'] . "</td>
                    <td><a href='" . $row['link'] . "'>" . $row['link'] . "</a></td>
                  </tr>";
        }

    } 
} else {
    echo "Error: " . mysqli_error($conn);
}


$today = date('Y-m-d');

$start_of_week = date('Y-m-d H:i:s', strtotime('monday this week 09:00:00', strtotime($today)));
$end_of_week = date('Y-m-d H:i:s', strtotime('sunday this week 17:00:00', strtotime($today)));


$nastavnik=$_SESSION['username'];
$sql = "SELECT*
    FROM casovi
    WHERE nastavnik='$nastavnik' 
    AND prihvacen=1
    AND pocetak BETWEEN '$start_of_week' AND '$end_of_week'
";
$result = mysqli_query($conn,$sql);
echo '</br>';
?>
</table>
<h2> Raspored časova </h2>
<table border="1">
    <tr>
        <th>Vreme</th>
        <th>Ponedeljak</th>
        <th>Utorak</th>
        <th>Sreda</th>
        <th>Četvrtak</th>
        <th>Petak</th>
    </tr>
    <tr>
    <?php 
    for ($hour = 10; $hour <= 18; $hour++) {
        echo '<td>';
        echo sprintf("%02d:00\n", $hour);
        echo '</td>';
        for($day=0;$day<5;$day++){
            echo '<td>';
            $datum = date('Y-m-d H:i:s', strtotime(date('Y-m-d', strtotime($start_of_week)) . " $hour:00:00 +$day days"));

            $sql2="SELECT *
            FROM casovi
            WHERE '$datum' BETWEEN DATE_SUB(pocetak, INTERVAL 1 SECOND) AND DATE_SUB(kraj, INTERVAL 1 SECOND) AND prihvacen=1
             AND nastavnik='$nastavnik'";
            $result=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                echo $row['ucenik'];
            }else{
                echo '/';
            }
            //echo $datum;
            echo '</td>';
        }
        echo '</tr>';
    }
    ?>
</table>
<h2>Zahtevi</h2>

<table border="1">
<tr>
<th>Predmet</th>
<th>Ime</th>
<th>Prezime </th>
<th>Početak časa</th>
<th>Kraj časa</th>
<th>Komentar</th>
<th>Ocena</th>
<th>Prihvati</th>
<th>Odbij</th>
</tr>

<?php
$sql = "SELECT * FROM casovi WHERE odrzan=0 AND nastavnik='$user'
 AND prihvacen!=1 AND kraj >= DATE_SUB(NOW(), INTERVAL 1 HOUR) ORDER BY pocetak ASC"; 
$result = mysqli_query($conn, $sql);

if ($result) {
    $br=0;
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $user=$row['ucenik'];
            $pocetak=$row['pocetak'];
            $nastavnik=$_SESSION['username'];
            $sql22="SELECT * FROM ucenici WHERE username='$user'";
            $result2=mysqli_query($conn,$sql22);
            $row2=mysqli_fetch_assoc($result2);
            if($row['prihvacen']=='-1'){
                echo "<tr style='color:red'>";
            }
            else{
                echo "<tr>";
            }
            echo "
                    <td>" . $row['naziv'] . "</td>
                    <td>" . $row2['ime'] . "</td>
                    <td>" . $row2['prezime'] . "</td>
                    <td>" . $row['pocetak'] . "</td>
                    <td>" . $row['kraj'] . "</td>
                    <td>" . $row['porukaucenik'] . "</td>";

            $sql44="SELECT AVG(ocenaucenik) AS avg_ocenaucenik FROM casovi WHERE ocenaucenik>0 AND ucenik='$user'";
            $result44=mysqli_query($conn,$sql44);
            $row44=mysqli_fetch_assoc($result44);
            $ocena44=$row44['avg_ocenaucenik'];
            //echo $ocena44;
            $sql55="SELECT COUNT(ocenaucenik) AS count_ocenaucenik FROM casovi WHERE ocenaucenik>0 AND ucenik='$user'";
            $result55=mysqli_query($conn,$sql55);
            $row55=mysqli_fetch_assoc($result55);
            $ocena55=$row55['count_ocenaucenik'];
            //echo $ocena55;
            echo "<td>";
            if($ocena55>2){
                echo $ocena44;
            }
            echo "</td>";
            ?>
            <form method="post" action="obradizahtev.php">
                <td><input type="submit" name='btn' value="Prihvati"></td>
                <input type="hidden" name="idC" value="<?php echo $row['idC'];?>">
            </form>

            <form method="post" action="obradizahtev.php">
                <td><input type="submit" name='btn' value="Odbij"></td>
                <input type="hidden" name="idC" value="<?php echo $row['idC'];?>">
            </form>
            <?php
                    
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