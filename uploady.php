
<html>
    <form method="post">
        <table>
            <tr>
                <td>Unesite predmet:</td>
                <td><input type="text" name="novipredmet"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Potvrdi" name="btn"></td>
            </tr>
        </table>
    </form>
</html>
<?php
    if(isset($_POST['btn'])){
        require 'veza.php';
        session_start();
        $username=$_SESSION['username'];
        $predmet=$_POST['novipredmet'];
        $sql="INSERT INTO predmeti (naziv,username) VALUES ('$predmet','$username')";
        $result=mysqli_query($conn,$sql);
        ?>
        <script>
    window.parent.location.reload();
    </script>
        <?php
    }
?>