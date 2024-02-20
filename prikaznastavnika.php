<html>
<?php
    function displayStars($rating) {
        if ($rating < 0 || $rating > 5) {
            
            return;
        }
    
        $roundedRating = round($rating);
        $fullStars = floor($roundedRating);
        $emptyStars = 5 - $fullStars;
    
        echo " ";
        for ($i = 0; $i < $fullStars; $i++) {
            echo "★"; 
        }
        for ($i = 0; $i < $emptyStars; $i++) {
            echo "☆"; 
        }
    }
    session_start();
    require 'veza.php';
    $user=$_SESSION['username'];
    $sql="SELECT*  FROM ucenici WHERE username = '$user'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $razred=$row['razred'];
    ?>
    <script>
    function redirectToPage(page, actionNumber) {
    
    window.location.href = page + '?action=' + actionNumber;
    }
    </script>
    <center>
    <h2> MOJI NASTAVNICI </h2>
    <form method='post' action='pretraga2.php'>
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
    <table border='1'>
                <tr>
                    <th >Predmet</th>
                    <th >Ime</th>
                    <th >Prezime</th>
                    <th> Link</th>
                    <th> Ocena</th>
                </tr>
            
                <tr>
                    <td><input type='button' value='↑'name='nazivG'onclick="redirectToPage('sort2.php', 1)">
                    <input type='button' value='↓' name='nazivD'onclick="redirectToPage('sort2.php', 2)"></td>

                    <td><input type='button'value='↑'name='imeG'onclick="redirectToPage('sort2.php', 3)"  >
                    <input type='button'value='↓' name='imeD'onclick="redirectToPage('sort2.php', 4)"></td>

                    <td><input type='button'value='↑' name='prezimaG'onclick="redirectToPage('sort2.php', 5)">
                    <input type='button'value='↓' name='prezimeD'onclick="redirectToPage('sort2.php', 6)"></td>
                    <td></td>
                    <td></td>
                </tr>
<?php    

if($razred<5){
$sql="SELECT nastavnici.ime, nastavnici.prezime, predmeti.naziv,nastavnici.username
FROM nastavnici
JOIN predmeti ON nastavnici.username = predmeti.username
WHERE nastavnici.potvrdjen = 1 AND (nastavnici.razred='1-4' OR nastavnici.razred='1-8')";
}

else if($razred>=5){
    $sql="SELECT nastavnici.ime, nastavnici.prezime, predmeti.naziv,nastavnici.username
FROM nastavnici
JOIN predmeti ON nastavnici.username = predmeti.username
WHERE nastavnici.potvrdjen = 1 AND (nastavnici.razred='5-8' OR nastavnici.razred='1-8')";
}

if(isset($_SESSION["pretraga2"])){
    if($_SESSION['param2']=='Predmet'){
        $sql.=" AND predmeti.naziv LIKE '%".$_SESSION['pretraga2']."%'";
    }
    else if($_SESSION['param2']=='Ime'){
        $sql.=" AND nastavnici.ime LIKE '%".$_SESSION['pretraga2']."%'";
    }
    else if($_SESSION['param2']=='Prezime'){
        $sql.=" AND nastavnici.prezime LIKE '%".$_SESSION['pretraga2']."%'";
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
        $sql .= " ORDER BY naziv ASC";
    }
} 
//$sql .= " ORDER BY naziv DESC";
$result = mysqli_query($conn, $sql);            
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            //$user=$row['username'];
            //echo $user;
            $user=$row['username'];
            $sql3="SELECT AVG(ocenanastavnik) AS prosek FROM casovi WHERE nastavnik='$user' AND ocenanastavnik>0";
            $result2=mysqli_query($conn,$sql3);
            $row3=mysqli_fetch_assoc($result2);
            if($row3['prosek']==""){
                $row3['prosek']="Nema";
            }

            //echo $user;
            echo "<tr>
                    <td>" . $row['naziv'] . "</td>
                    <td>" . $row['ime'] . "</td>
                    <td>" . $row['prezime'] . "</td>
                    <td><a href='nastavnik2.php?id=$user'>link</a></td>
                    <td>" . $row3['prosek'] . "
                    
                  ";
                  displayStars($row3['prosek']);
                  echo "</td></tr>";
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
</html>