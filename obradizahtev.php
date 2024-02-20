
<?php

        require 'veza.php';
        $prvo=$_POST['btn'];
        $drugo=$_POST['idC'];
        
        if($_POST['btn']=='Prihvati'){
                   
            echo 'Unesite link:';
            ?>
            <form action='dodajlink.php' method='post'>
            <input type='text' name='link' id='link'>
            <input type='hidden' name='idC' value='<?php echo $drugo;?>'>

            <input type='submit' value='Prosledi'>
            </form>
            <?php
    
        
            $idC=$_POST['idC'];
            $sql="UPDATE casovi SET prihvacen=1 WHERE idC='$idC'";
            $result=mysqli_query($conn,$sql);
            }
            else{
                echo 'Unesite komentar:';
                ?>
                <form action='dodajkom.php' method='post'>
                    <input type='text' name='komentar' id='komentar'>
                    <input type='hidden' name='idC' value='<?php echo $drugo;?>'>
                    <input type='submit' value='Prosledi'>
                    </form>
                <?php
                
                $idC=$_POST['idC'];
                $sql="UPDATE casovi SET prihvacen=-1 WHERE idC='$idC'";
                $result=mysqli_query($conn,$sql);
                //header("Location:casovinastavnik.php");
            }
        
        
    
    //header("Location:casovinastavnik.php");
?>