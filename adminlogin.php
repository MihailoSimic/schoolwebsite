<?php
require 'veza.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql="SELECT* FROM admini WHERE username = '$username' AND password = '$password'";

    $result=mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    if($row==null){
        echo "Pogresno korisnicko ime ili lozinka";
    }else{
        session_start();
        $_SESSION['username']=$row['username'];
        $_SESSION['password']=$row['password'];
        $_SESSION['tip']="admin";
        header("location:admin.php");
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
        <h4>Prijava administratora</h4>
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