<?php
require 'veza.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $datum=$_POST['datum'];
    $vremeP=$_POST['vremeP'];
    $vremeK=$_POST['vremeK'];
    $predmet=$_POST['predmet'];
    $poruka=$_POST['komentar'];
    $pocetak=$datum.' '.$vremeP;
    $kraj=$datum.' '.$vremeK;
    session_start();
    $nastavnik=$_GET['id'];
    $ucenik=$_SESSION['username'];
    //echo $poruka;


    $provera="SELECT* FROM casovi WHERE 
    (('$pocetak'>= pocetak AND '$pocetak' <kraj)
    OR ('$kraj' > pocetak AND '$kraj' <= kraj)
    OR ('$pocetak'<= pocetak AND '$kraj' >= kraj))
    AND nastavnik='$nastavnik' AND prihvacen='1'";
    $resprovera=mysqli_query($conn,$provera);
    if($kraj<$pocetak){
        echo "<script>alert('Neispravno uneto vreme.');</script>";
    }
    else if(mysqli_num_rows($resprovera)>0){
        echo "<script>alert('Profesor je zauzet u ovom terminu');</script>";
    }
    else{
        $sql="INSERT INTO casovi(naziv, nastavnik, ucenik, pocetak, kraj, porukaucenik,prihvacen) 
    VALUES ('$predmet','$nastavnik','$ucenik','$pocetak','$kraj','$poruka',0)";
    $result=mysqli_query($conn,$sql);
    }
    


}
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
        $username=$_GET['id'];
        $imageName = $username;
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
?>
        <table>
            <tr>
                <td style="padding-right:10px">Korisnicko ime:</td>
                <td style="padding-right:40px">
                    <?php  
                    $username=$_GET['id'];
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
            

        <?php
        $today = date('Y-m-d');
            
        $start_of_week = date('Y-m-d H:i:s', strtotime('monday this week 09:00:00', strtotime($today)));
        $end_of_week = date('Y-m-d H:i:s', strtotime('sunday this week 17:00:00', strtotime($today)));

        $nastavnik=$username;
        $sql = "SELECT*
            FROM casovi
            WHERE nastavnik='$nastavnik' 
            AND prihvacen=1
            AND pocetak BETWEEN '$start_of_week' AND '$end_of_week'
            ";
        $result = mysqli_query($conn,$sql);
        echo '</br>';

        ?>
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
            WHERE '$datum' BETWEEN DATE_SUB(pocetak, INTERVAL 1 SECOND) AND DATE_SUB(kraj, INTERVAL 1 SECOND) AND prihvacen=1 AND nastavnik='$nastavnik'";
            $result=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                echo 'zauzeto';
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
</br>
        <h2> Zakazivanje casa </h2>
        
<form method='post' id="myForm">
    <table>
        <tr>
            <td>Početak časa: </td>
            <td><input type="date" id='datum' name="datum" min="<?php echo date('Y-m-d'); ?>">
             <input type="time" name="vremeP" id="vremeP" min="10:00" max="17:00" step="3600" value="10:00" ></td>
            <td>Kraj časa: </td>
            <td><input type="time" name="vremeK" id="vremeK" min="11:00" max="18:00" step="3600" value="11:00"></td>
        </tr>
        <tr>
            <td colspan="2">Predmet: </td>
            <td colspan="2">
            <?php 
            $sql2="SELECT* FROM predmeti WHERE username='$username'";
                $result2 = mysqli_query($conn, $sql2); 
                if ($result2) {
                    if (mysqli_num_rows($result2) > 0) {
                        if(mysqli_num_rows($result2)==1){
                            $row2 = mysqli_fetch_assoc($result2);
                            echo "";
                            ?>
                                <select disabled>
                                <option><?php echo $row2['naziv']?></option>
                                <input type='hidden' name='predmet' value="<?php echo $row2['naziv']?>">
                            <?php
                            
                           
                        }
                        else{
                            echo "<select name='predmet'>";
                        
                        while ($row2 = mysqli_fetch_assoc($result2)) {
        
                            echo "<option>" . $row2['naziv'] . "</option>";
                        }
                
                        echo "</select>";
                        }
                    } 
                }
                ?>
            </td>
        </tr>
        <tr>
            <td>Komentar: </td>
            <td><textarea name="komentar" rows="4" cols="40"> </textarea></td>        
        </tr>
        <tr>
                <td></td><td></td><td></td>
                <td><button type="submit">Zakaži čas</button></td>
        </tr>
    </table>
</form>
<script>
document.getElementById("myForm").addEventListener("submit", function(event) {
    var selectedDate = new Date(document.getElementById("datum").value);
    var dayOfWeek = selectedDate.getDay(); 

    
    if (dayOfWeek === 0 || dayOfWeek === 6) {
        event.preventDefault(); 
        alert("Casovi se zakazuju samo radnim danima");
    }
});
</script>
<h2> Komentari i ocene <h2>
<table border="1">
    <th>Učenik </th>
    <th>Komentar </th>
    <th>Ocena</th>
<?php
    $sql3="SELECT* FROM casovi WHERE nastavnik='$nastavnik' AND ocenanastavnik>0";
    $result3 = mysqli_query($conn, $sql3);
    while($row=mysqli_fetch_assoc($result3)){
        echo '<tr>';
        echo '<td>'.$row['ucenik'].'</td>';
        echo '<td>'.$row['komentarucenik'].'</td>';
        echo '<td>'.$row['ocenanastavnik'].'</td>';
        echo '</tr>';
    }
?>


</table>


    </center>
</body>
</html>