
<?php
        require 'veza.php';
        $brojac=0;
        $maks=$_POST['max'];
        
        while ($brojac<=$maks){
            if(isset($_POST[$brojac])){
                $brojac2=(string)$brojac;
                $brojac2=$brojac2."a";
                echo $_POST[$brojac2];
                echo$_POST[$brojac];
                if($_POST[$brojac]=='Potvrdi'){

                
                $username=$_POST[$brojac2];
                $sql1="SELECT * FROM predmeti WHERE username='$username'";
                $result1=mysqli_query($conn,$sql1);
                while($row=mysqli_fetch_assoc($result1)){
                    $predmet=$row['naziv'];
                    $sql2="SELECT * FROM predmeti WHERE naziv='$predmet' AND username=''";
                    $result2=mysqli_query($conn,$sql2);
                    if(mysqli_num_rows($result2)==0){
                        $sql3 = "INSERT INTO `predmeti` (`naziv`, `username`) VALUES ('$predmet', '')";
                        $result3=mysqli_query($conn,$sql3);
                    }
                }
                $sql="UPDATE nastavnici SET potvrdjen=1, odbijen=0 WHERE username='$username'";
                $result=mysqli_query($conn,$sql);
            }
            else{
                $brojac2=(string)$brojac;
                $brojac2=$brojac2."a";
                $username=$_POST[$brojac2];
                $sql="UPDATE nastavnici SET potvrdjen=0, odbijen=1 WHERE username='$username'";
                $result=mysqli_query($conn,$sql);
            }
        }
        $brojac++;
    }
    header("Location:admin.php");
?>