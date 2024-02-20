<?php
    session_start();
    if($_SESSION['tip']=="ucenik"){
        header("location:profilucenika.php");
    }
    else if($_SESSION['tip']=="nastavnik"){
        header("location:profilnastavnika.php");
    }
?>