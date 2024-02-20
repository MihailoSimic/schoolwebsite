<?php

require 'veza.php';

$today = date('Y-m-d');


$start_of_week = date('Y-m-d H:i:s', strtotime('monday this week 09:00:00', strtotime($today)));
$end_of_week = date('Y-m-d H:i:s', strtotime('sunday this week 17:00:00', strtotime($today)));

echo $start_of_week;
echo '</br>';
echo $end_of_week;
echo '<br>';
echo '<br>';
$nastavnik='Golub';
$sql = "
    SELECT*
    FROM casovi
    WHERE nastavnik='$nastavnik'
    AND pocetak BETWEEN '$start_of_week' AND '$end_of_week'
";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($result)){
    echo $row['pocetak'];
    echo '</br>';
    echo $row['kraj'];
    echo '</br>';
    echo '<br>';
}

$nastavnik='Golub';
$sql = "
    SELECT*
    FROM casovi
    WHERE nastavnik='$nastavnik'
    AND pocetak BETWEEN '$start_of_week' AND '$end_of_week'
";
$result = mysqli_query($conn,$sql);
?>
<table border='1'>
    <tr>
        <th>Vreme</th>
        <th>Ponedeljak</th>
        <th>Utorak</th>
        <th>Sreda</th>
        <th>Cetvrtak</th>
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
            WHERE '$datum' BETWEEN DATE_SUB(pocetak, INTERVAL 1 SECOND) AND DATE_SUB(kraj, INTERVAL 1 SECOND)";
            $result=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result)>0){
                $row=mysqli_fetch_assoc($result);
                echo $row['ucenik'];
            }else{
                echo '0';
            }
            //echo $datum;
            echo '</td>';
        }
        echo '</tr>';
    }
    ?>
</table>