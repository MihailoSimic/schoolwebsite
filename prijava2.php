
<?php
session_start();
if (isset($_SESSION["username"])){
    if($_SESSION['tip']=='nastavnik'){
            header("Location: profilnastavnika.php");
    }else{
            header("Location: profilucenika.php");
        }

    } else{
    header("Location: glavna.php");
}
?>