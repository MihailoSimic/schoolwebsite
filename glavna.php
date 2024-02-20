<html>
<head>
    <link rel="stylesheet" type="text/css" href="stilovi.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


    <script>
function redirectToPage(page, actionNumber) {
    
    window.location.href = page + '?action=' + actionNumber;
}
</script>
</head>
<body>
    <center>
        <h2>DOBRODOSLI!</h2>
        <table> 
            <tr>
                <td>Broj ucenika:
                    <?php 
                    require 'veza.php';
                    $osvezi="UPDATE casovi SET odrzan=1 WHERE kraj<NOW()";
                    $result22=mysqli_query($conn, $osvezi);
                    $sql='SELECT COUNT(username) FROM ucenici';
                    $result=mysqli_query($conn,$sql);
                    $row=mysqli_fetch_row($result);
                    echo $row[0];
                    ?>
                </td>
                <td></td>
                <td>Broj nastavnika:
                    <?php 
                    
                    $sql='SELECT COUNT(username) FROM nastavnici WHERE potvrdjen=1';
                    $result=mysqli_query($conn,$sql);
                    $row=mysqli_fetch_row($result);
                    echo $row[0];
                    ?></td>
                <td></td>
            </tr>
            <tr>
                <?php
                    $sql="SELECT COUNT(*) 
                    FROM casovi
                    WHERE kraj >= DATE_SUB(NOW(), INTERVAL 1 MONTH) AND odrzan=1";
                    $result=mysqli_query($conn,$sql);
                    $row=mysqli_fetch_row($result);
                ?>
                <td colspan="4" style="text-align:center">Broj odrzanih casova u poslednjih mesec dana: <?php echo $row[0];?></td>
                
            </tr>

        </table>
        
        <?php
require 'veza.php';
echo "<h4>Nastavnici po predmetima</h4>";

$prazan='';
?>
<form method='post' action='pretraga.php'>
    <table>
        <tr>
            <td>Izaberite parametar pretrazivanja:</td>
            <td>
        <select name="parametar">
            <option>Predmet</option>
            <option>Ime</option>
            <option>Prezime</option>
        </select></br>
            </td>
        </tr>
        <tr>
        <td colspan='2' style="text-align:center"><input type="text" name="pretraga"></br></td>
        
        </tr>
        <tr>
        <td colspan='2' style="text-align:center"><input type="submit" value="Pretrazi"></td>
        </tr>

    </table>
</form>
<form method='post'>
    <table border="1">
                
                <tr>
                    <th>Predmet</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    
                    
                </tr>
                <tr>
                    <td><input type='button' value='↑'name='nazivG'onclick="redirectToPage('sort1.php', 1)">
                    <input type='button' value='↓' name='nazivD'onclick="redirectToPage('sort1.php', 2)"></td>

                    <td><input type='button'value='↑'name='imeG'onclick="redirectToPage('sort1.php', 3)"  >
                    <input type='button'value='↓' name='imeD'onclick="redirectToPage('sort1.php', 4)"></td>

                    <td><input type='button'value='↑' name='prezimaG'onclick="redirectToPage('sort1.php', 5)">
                    <input type='button'value='↓' name='prezimeD'onclick="redirectToPage('sort1.php', 6)"></td>
                </tr>
                
<?php    
//$sql = "SELECT * FROM predmeti WHERE TRIM(username)<>''";
$sql="SELECT nastavnici.ime, nastavnici.prezime, predmeti.naziv
FROM nastavnici
JOIN predmeti ON nastavnici.username = predmeti.username
WHERE nastavnici.potvrdjen = 1";
//ORDER BY nastavnici.ime ASC";
session_start();
if(isset($_SESSION["pretraga"])){
    if($_SESSION['param']=='Predmet'){
        $sql.=" AND predmeti.naziv LIKE '%".$_SESSION['pretraga']."%'";
    }
    else if($_SESSION['param']=='Ime'){
        $sql.=" AND nastavnici.ime LIKE '%".$_SESSION['pretraga']."%'";
    }
    else if($_SESSION['param']=='Prezime'){
        $sql.=" AND nastavnici.prezime LIKE '%".$_SESSION['pretraga']."%'";
    }
}
if(isset($_SESSION['sort'])){
    $pom=$_SESSION['sort'];
    if($pom==1){
        $sql .=" ORDER BY naziv DESC";
    }else if($pom== 2){
        $sql .= " ORDER BY naziv ASC";
    }
    else if($pom== 3){
        $sql .= " ORDER BY ime DESC";
    }
    else if($pom== 4){
        $sql .= " ORDER BY ime ASC";
    }
    else if($pom== 5){
        $sql .= " ORDER BY prezime DESC";
    }
    else if($pom== 6){
        $sql .= " ORDER BY prezime ASC";
    }
} 
//$sql .= " ORDER BY naziv DESC";
$result = mysqli_query($conn, $sql);            
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            //$user=$row['username'];
            //echo $user;
            //$sql="SELECT * FROM nastavnici WHERE username='$user'";
            //$result2=mysqli_query($conn,$sql);
            //$row2=mysqli_fetch_assoc($result2);
            echo "<tr>
                    <td>" . $row['naziv'] . "</td>
                    <td>" . $row['ime'] . "</td>
                    <td>" . $row['prezime'] . "</td>
                    
                    
                  </tr>";
        }

        echo "</table>";
        echo "</form>";
    } else {
        echo "Nema aktivnih nastavnika.";
        echo "</table>";
        echo "</form>";
    }
} else {
    echo "Error: " . mysqli_error($conn);
    echo "</table>";
    echo "</form>";
}
?>

    </center>
</body>
</html>

