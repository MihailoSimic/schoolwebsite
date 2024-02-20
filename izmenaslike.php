<?php
    session_start();
    $x=$_SESSION['username'];
?>
<html>
<body>
<center>
<h2>Azuriranje profilne slike</h2>
<form action="obradisliku.php" method="post" enctype="multipart/form-data">
    <table>
        <tr>
        <td>Nova slika:</td>
        <td><input type="file" id="newPicture" name="newPicture" accept=".png, .jpg"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Promeniti" name="submit">
                <input type="hidden" id="pictureName" name="pictureName" value="<?php echo $x ?>">
        </td>
        </tr>
    </table>
</form>
</center>
</body>
</html>