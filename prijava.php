<?php
require 'veza.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hashedpassword=md5($password);
    $sql="SELECT* FROM nastavnici WHERE username = '$username' AND password = '$hashedpassword'";

    $result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    if($row==null){
        $sql2="SELECT* FROM ucenici WHERE username = '$username' AND password = '$hashedpassword'";

    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_assoc($result2);
    //echo (string)$row2['username'];
    if($row2==null){
        echo "<script>alert('Pogresno korisnicko ime ili lozinka')</script>";
        
    }
    else{
        session_start();
        $_SESSION['username']=$row2['username'];
        $_SESSION['password']=$row2['password'];
        $_SESSION['tip']="ucenik";
        $_SESSION['x']='prijava';
        ?>
        <script>
        window.parent.location.reload();
        </script>
        <?php
        
        //header("location:profilucenika.php");
    }
    }else if($row['odbijen']=='1'){
        echo "<script> alert('Nastavniku je zabranjen pristup aplikaciji.')</script>";
    }
    else{
        session_start();
        $_SESSION['username']=$row['username'];
        $_SESSION['password']=$row['password'];
        $_SESSION['tip']="nastavnik";
        $_SESSION['x']='prijava';
        ?>
        <script>
        window.parent.location.reload();
        </script>
        <?php
        //header("location:profilnastavnika.php");
    }

}

//$sql="SELECT* FROM ucenici WHERE username='$username'";

//$result=mysqli_query($conn,$sql);
?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="stilovi.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script>
        function osvezi(){
        window.parent.location.reload();
       
        }
    </script>
</head>
<body>
    <center>
        <h4>Prijava </h4>
        <form name=forma2 method="post">
        <table>
            <tr>
                <td>Korisnicko ime:</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Lozinka:</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Prijavi se"></td>
            </tr>
        </table>
        </form>
    </center>
</body>
</html>